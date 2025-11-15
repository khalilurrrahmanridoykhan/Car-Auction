#!/usr/bin/env python3
"""
Script to convert Mermaid HTML diagrams to PNG images
Requires: playwright
Install: pip install playwright && playwright install chromium
"""

import os
import asyncio
from playwright.async_api import async_playwright

diagrams_dir = "/Users/khalilur/Downloads/garikinbo-main 2/diagrams"

# List of diagram HTML files
diagram_files = [
    "system_architecture.html",
    "database_er_diagram.html",
    "user_authentication_flow.html",
    "bidding_flow.html",
    "auction_creation_flow.html",
    "technology_stack.html",
    "admin_workflow.html",
    "test_case_flow.html",
    "future_roadmap.html",
    "use_case_diagram.html"
]

async def convert_html_to_png(html_file, output_file):
    """Convert HTML file with Mermaid diagram to PNG"""
    async with async_playwright() as p:
        browser = await p.chromium.launch()
        page = await browser.new_page(viewport={'width': 1920, 'height': 1080})

        # Load the HTML file
        file_path = f"file://{os.path.join(diagrams_dir, html_file)}"
        await page.goto(file_path)

        # Wait for Mermaid to render
        await page.wait_for_timeout(3000)

        # Get the diagram element
        diagram = await page.query_selector('.mermaid')

        if diagram:
            # Take screenshot of the diagram
            await diagram.screenshot(path=output_file)
            print(f"✓ Created: {output_file}")
        else:
            print(f"✗ Failed: Could not find diagram in {html_file}")

        await browser.close()

async def main():
    """Convert all diagrams"""
    print("Converting HTML diagrams to PNG...\n")

    for html_file in diagram_files:
        # Generate output filename
        png_file = html_file.replace('.html', '.png')
        output_path = os.path.join(diagrams_dir, png_file)

        # Convert
        try:
            await convert_html_to_png(html_file, output_path)
        except Exception as e:
            print(f"✗ Error converting {html_file}: {str(e)}")

    print("\n✓ All diagrams converted successfully!")
    print(f"\nDiagrams saved in: {diagrams_dir}")

if __name__ == "__main__":
    asyncio.run(main())
