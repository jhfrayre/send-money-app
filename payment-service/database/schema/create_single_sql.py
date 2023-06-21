## This is a modified AI-generated script.

import os
import re

# Helper function to extract numeric part from filename
def natural_sort_key(s):
    return [int(x) if x.isdigit() else x for x in re.split(r'(\d+)', s)]

def merge_sql_files(directory, output_file):
    # Get the list of SQL files and sort them based on filename
    sql_files = sorted(os.listdir(directory), key=natural_sort_key)

    with open(output_file, 'w') as outfile:
        for filename in sql_files:
            if filename.endswith('.sql'):
                file_path = os.path.join(directory, filename)
                with open(file_path, 'r') as infile:
                    outfile.write('/* ' + filename +' */\n')
                    outfile.write(infile.read())
                    outfile.write('\n')  # Add a separator between files

# Directory containing SQL files
sql_directory = './'

# Output file path
output_file = './create_tables_and_insert_data.sql'

# Delete file if exists to prevent multiple rewrites
if os.path.exists(output_file):
    os.remove(output_file)

# Merge SQL files
merge_sql_files(sql_directory, output_file)

print("SQL files merged successfully into '" + output_file + "'." )
