#!/usr/bin/env sh
#
# by Siddharth Dushantha 2023
#
# Dependencies: ebook-convert
#

print_error() {
    printf "%b\n" "\e[91;1m✖\e[0m $1" >&2
    exit 1
}

print_good() {
    printf "%b\n" "\033[92;1m✓\033[0m $1" >&2
}

main() {
    # The PDF that contains our tasks
    assignment_pdf="$1"

    # The PDF of the assignment needs to be provided
    [ -z "$assignment_pdf" ] && print_error "Please provide the PDF to of the assignment: setup.sh <FILE>"

    # Check if provided file is actually a PDF
    if ! file --mime-type "$assignment_pdf" | grep -Eq "application/pdf"; then
        print_error "$assignment_pdf is not a valid PDF"
    fi

    # Check if user has 'ebook-convert' installed
    if ! command -v "ebook-convert" >/dev/null 2>&1; then
        print_error "'ebook-convert' needs to be installed"
    fi

    printf "%b" "\033[34m~\033[0m Extracting text from $assignment_pdf"

    # Convert the PDF into text
    ebook-convert "$assignment_pdf" out.txt >/dev/null

    # Extract the module heading
    module_heading=$(grep -E "Innlevering [0-9]{1,2}.*$" -o out.txt |  tr -d '\n') 
 
    # Extracts the module number. "Innlevering 8" -> "8"
    module_number=$(echo "$module_heading" | grep -E "[0-9]{1,2}" -o)

    # The module_name an English versjon module_heading where spaces are replaced with a hyphene
    module_name=$(echo "$module_heading" | grep -E "Innlevering [0-9]{1,2}" -o | sed 's/Innlevering/module/' | tr " " "-")

    # Let the user know if a directory with the module's name already exists.
    # We could programmatically ask the user if they'd like to overwrite the content
    # but it's safer to do nothing as these are important assignments
    [ -d "$module_name" ] && printf "%b\r" "\e[2K" && print_error "$module_heading already exists!"

    printf "%b\r" "\e[2K"
    print_good "Text extracted from $module_heading!"

    # Create directory for this module
    mkdir -p $module_name/solution

    # Copy template into the module's directory
    cp "templates/index.php" "$module_name/solution"

    # Add the module heading to index.php
    sed -i "s/{{{MODULE_HEADING}}}/$module_heading/g" "$module_name/solution/index.php"

    # Extract all the task names from the assignment
    task_names=$(grep -E "^Oppgave [0-9]{1,2}:\s.*$" -o out.txt)

    # Just a simple counter so that we can assign the correct task number to each task file
    task_number=1

    printf "%b" "\033[34m~\033[0m Setting up files from templates"

    while IFS= read -r task_name; do
        # Task file name example: index1_3.php
        #                              │ │
        #                              │ └ task number
        #                              └ assignment number
        task_file_path="$module_name/solution/index${module_number}_${task_number}.php"

        # Copy the template of the task file into our module's directory
        cp "templates/task-file.php" "$task_file_path"

        # Set the task name in the task file's heading
        sed -i "s/{{{TASK_NAME}}}/$task_name/g" "$task_file_path"

        # Lets go to the next task
        ((task_number++))
    done <<< "$task_names"

    # Time for some clean up
    rm out.txt
    mv "$assignment_pdf" "$module_name/$module_name.pdf"

    printf "%b\r" "\e[2K"
    print_good "Files have been setup!"
    print_good "Good luck on your assignment!"

}

main "$@"
