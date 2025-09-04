# Sri Lankan Salary Tax Calculator WordPress Plugin

A WordPress plugin that accurately calculates income tax for Sri Lankan salaries according to the official tax brackets and rates. Perfect for HR departments, accountants, and individuals who need to quickly estimate their tax obligations.

![WordPress](https://img.shields.io/badge/WordPress-5.0%2B-blue?style=flat-square&logo=wordpress)
![PHP](https://img.shields.io/badge/PHP-7.0%2B-purple?style=flat-square&logo=php)
![License](https://img.shields.io/badge/License-GPL--2.0-orange?style=flat-square)

## Features

- ✅ **Accurate Sri Lankan Tax Calculations** - Implements the official Sri Lankan tax formula
- ✅ **Elementor Support** - Includes shortcode for easy integration with Elementor page builder
- ✅ **Responsive Design** - Works seamlessly on desktop and mobile devices
- ✅ **AJAX-Powered** - Instant calculations without page reloads
- ✅ **User-Friendly Interface** - Clean, intuitive design with clear input and result display
- ✅ **Professional Formatting** - Results displayed with proper number formatting

## Installation

1. Download the plugin ZIP file from the [Releases section](https://github.com/MadushaHero/Sri-Lankan-Salary-Tax-Calculator/releases)
2. In your WordPress admin panel, navigate to Plugins → Add New → Upload Plugin
3. Upload the ZIP file and click "Install Now"
4. After installation, click "Activate Plugin"
5. Use the shortcode `[salary_tax_calculator]` in any post, page, or Elementor widget

Alternatively, you can install manually:
1. Upload the `salary-tax-calculator` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

## Usage

1. Add the shortcode `[salary_tax_calculator]` to any post, page, or widget area
2. Enter the annual salary amount in the input field
3. Click "Calculate Tax" to see the results
4. The calculator will display:
   - Annual Salary
   - Total Tax Deduction
   - Net Salary After Tax



## Examples

- **Salary: LKR 200,000**
  - Tax: LKR 3,000 (1.5%)
  - Net Salary: LKR 197,000

- **Salary: LKR 500,000**
  - Tax: LKR 47,500 (9.5%)
  - Net Salary: LKR 452,500



## Frequently Asked Questions

### Does this plugin work with any WordPress theme?
Yes, the plugin is designed to work with most WordPress themes. The CSS is structured to minimize conflicts.

### Can I use this calculator in multiple places on my site?
Yes, you can use the `[salary_tax_calculator]` shortcode as many times as needed on your site.

### Is this plugin compatible with caching plugins?
Yes, the AJAX functionality works properly with most caching plugins.

### How often is the tax formula updated?
The tax formula follows Sri Lanka's official tax structure. If tax laws change, the plugin will be updated accordingly.

