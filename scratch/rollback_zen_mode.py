import os

def rollback_css_file(file_path):
    if not os.path.exists(file_path):
        print(f"File not found: {file_path}")
        return

    with open(file_path, 'r', encoding='utf-8', errors='ignore') as f:
        lines = f.readlines()

    # Find where Zen Mode CSS starts
    split_index = -1
    for i, line in enumerate(lines):
        if "/* Zen Mode: Hide Dashboard Sidebar" in line:
            split_index = i
            break

    if split_index != -1:
        # Remove from the split index to the end
        new_content = "".join(lines[:split_index]).strip()
        with open(file_path, 'w', encoding='utf-8') as f:
            f.write(new_content + "\n")
        print(f"Successfully rolled back CSS in: {file_path}")
    else:
        print(f"Zen Mode marker not found in: {file_path}")

rollback_css_file("public/assets/dashbaord/css/my-style.css")
rollback_css_file("public/assets/dashbaord/css-rtl/my-style.css")
