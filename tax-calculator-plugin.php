<?php
/*
Plugin Name: Salary Tax Calculator
Description: Calculates tax based on salary input using a specific formula. Includes shortcode for Elementor.
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class SalaryTaxCalculator {
    public function __construct() {
        add_shortcode('salary_tax_calculator', array($this, 'render_tax_calculator'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    public function enqueue_scripts() {
        wp_enqueue_style('tax-calculator-style', plugins_url('css/style.css', __FILE__));
        wp_enqueue_script('tax-calculator-script', plugins_url('js/script.js', __FILE__), array('jquery'), '1.0', true);
    }

    public function calculate_tax($salary) {
        $salary = floatval($salary);
        
        if ($salary <= 150000) {
            return 0;
        } elseif ($salary <= 233333) {
            return ($salary - 150000) * 0.06;
        } elseif ($salary <= 275000) {
            return (83333 * 0.06) + ($salary - 233333) * 0.18;
        } elseif ($salary <= 316667) {
            return (83333 * 0.06) + (41667 * 0.18) + ($salary - 275000) * 0.24;
        } elseif ($salary <= 358333) {
            return (83333 * 0.06) + (41667 * 0.18) + (41667 * 0.24) + ($salary - 316667) * 0.30;
        } else {
            return (83333 * 0.06) + (41667 * 0.18) + (41667 * 0.24) + (41666 * 0.30) + ($salary - 358333) * 0.36;
        }
    }

    public function render_tax_calculator() {
        ob_start();
        ?>
        <div class="tax-calculator-container">
            <h3>Salary Tax Calculator</h3>
            <div class="input-group">
                <label for="salary-input">Enter Your Annual Salary:</label>
                <input type="number" id="salary-input" placeholder="Enter amount in numbers">
                <button id="calculate-tax">Calculate Tax</button>
            </div>
            <div id="tax-result" style="display: none;">
                <h4>Tax Calculation Result</h4>
                <p>Annual Salary: <span id="display-salary"></span></p>
                <p>Tax Deduction: <span id="display-tax"></span></p>
                <p>Net Salary After Tax: <span id="display-net-salary"></span></p>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}

new SalaryTaxCalculator();

// Add JavaScript directly (alternative to external file)
add_action('wp_footer', 'tax_calculator_script');
function tax_calculator_script() {
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#calculate-tax').on('click', function() {
            var salary = $('#salary-input').val();
            
            if (salary === '' || isNaN(salary) || salary < 0) {
                alert('Please enter a valid salary amount');
                return;
            }
            
            // AJAX call to calculate tax
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'calculate_salary_tax',
                    salary: salary
                },
                success: function(response) {
                    if (response.success) {
                        $('#display-salary').text(formatNumber(response.data.salary));
                        $('#display-tax').text(formatNumber(response.data.tax));
                        $('#display-net-salary').text(formatNumber(response.data.net_salary));
                        $('#tax-result').show();
                    } else {
                        alert('Error calculating tax. Please try again.');
                    }
                },
                error: function() {
                    alert('Error calculating tax. Please try again.');
                }
            });
        });
        
        function formatNumber(num) {
            return parseFloat(num).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }
    });
    </script>
    <?php
}

// AJAX handler for tax calculation
add_action('wp_ajax_calculate_salary_tax', 'calculate_salary_tax_ajax');
add_action('wp_ajax_nopriv_calculate_salary_tax', 'calculate_salary_tax_ajax');
function calculate_salary_tax_ajax() {
    if (!isset($_POST['salary'])) {
        wp_send_json_error('Salary not provided');
    }
    
    $salary = floatval($_POST['salary']);
    $calculator = new SalaryTaxCalculator();
    $tax = $calculator->calculate_tax($salary);
    $net_salary = $salary - $tax;
    
    wp_send_json_success(array(
        'salary' => $salary,
        'tax' => $tax,
        'net_salary' => $net_salary
    ));
}