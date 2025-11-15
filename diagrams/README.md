# Diagram Generation Instructions

## Automatic Conversion to PNG

### Method 1: Using Python Script (Recommended)

1. **Install Required Dependencies:**

   ```bash
   pip install playwright
   playwright install chromium
   ```

2. **Run the Conversion Script:**

   ```bash
   cd "/Users/khalilur/Downloads/garikinbo-main 2/diagrams"
   python3 convert_to_png.py
   ```

3. **Result:** All PNG files will be created in the diagrams folder.

---

### Method 2: Manual Conversion (Using Browser)

1. **Open Each HTML File in Browser:**

   - Navigate to the diagrams folder
   - Open each HTML file in Chrome/Firefox/Safari

2. **Take Screenshot:**

   - Wait for the diagram to fully render (2-3 seconds)
   - Right-click on the diagram → "Inspect Element"
   - Right-click on the `<div class="mermaid">` element
   - Select "Capture node screenshot" (Chrome DevTools)

3. **Save as PNG:**
   - Save with the same name (e.g., system_architecture.png)

---

### Method 3: Using Online Mermaid Editor

1. **Visit:** https://mermaid.live/

2. **Copy Diagram Code:**

   - Open each HTML file
   - Copy the content inside `<div class="mermaid">...</div>`

3. **Paste and Export:**
   - Paste into Mermaid Live Editor
   - Click "Export" → "PNG"
   - Save with appropriate name

---

## Available Diagrams

1. **system_architecture.png** - Overall system architecture
2. **database_er_diagram.png** - Database entity-relationship diagram
3. **user_authentication_flow.png** - User authentication process
4. **bidding_flow.png** - Real-time bidding workflow
5. **auction_creation_flow.png** - Auction creation process
6. **technology_stack.png** - Technology stack diagram
7. **admin_workflow.png** - Admin panel workflow
8. **test_case_flow.png** - Testing process flow
9. **future_roadmap.png** - Future development roadmap
10. **use_case_diagram.png** - System use cases

---

## Diagram Mapping to Chapters

### Chapter 5 - Implementation

- system_architecture.png
- technology_stack.png
- database_er_diagram.png
- user_authentication_flow.png
- auction_creation_flow.png
- bidding_flow.png
- admin_workflow.png
- use_case_diagram.png

### Chapter 6 - Testing

- test_case_flow.png

### Chapter 7 - Conclusion

- future_roadmap.png

---

## Troubleshooting

**Issue:** Python script fails

- **Solution:** Make sure playwright is installed: `playwright install chromium`

**Issue:** Diagrams not rendering

- **Solution:** Wait 3-5 seconds for Mermaid.js to load

**Issue:** Screenshot is blank

- **Solution:** Try increasing wait time in the script

---

## Alternative: Quick Screenshot Tool

If you have issues with automation, you can use browser extensions:

- **Chrome:** GoFullPage, Awesome Screenshot
- **Firefox:** Fireshot
- **Safari:** Built-in screenshot tools

Simply open each HTML file and capture the full page.
