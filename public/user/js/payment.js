// Payment Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Payment method selection
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    const paymentForm = document.getElementById('payment_form');
    const selectedMethodSpan = document.getElementById('selected_method');
    const paymentBtn = document.getElementById('payment_btn');

    // Handle payment method selection
    paymentMethods.forEach(method => {
        method.addEventListener('change', function() {
            const selectedOption = this.closest('.payment_option');
            const methodLabel = selectedOption.querySelector('span').textContent;

            // Update selected method display
            selectedMethodSpan.textContent = methodLabel;

            // Show/hide payment form for banking option
            if (this.value === 'banking') {
                paymentForm.style.display = 'block';
            } else {
                paymentForm.style.display = 'none';
            }

            // Update payment option styles
            document.querySelectorAll('.payment_option').forEach(option => {
                option.classList.remove('selected');
            });
            selectedOption.classList.add('selected');
        });
    });

    // Promo code application
    const promoButton = document.querySelector('#apply_promo_btn');
    const promoInput = document.querySelector('#promo_code_input');

    if (promoButton) {
        promoButton.addEventListener('click', function() {
            const promoCode = promoInput.value.trim().toUpperCase();

            if (promoCode) {
                // Simulate promo code validation
                const validCodes = {
                    'FIRST10': { discount: 10000, name: 'Giảm 10% lần đầu' },
                    'WEEKEND20': { discount: 20000, name: 'Giảm 20% cuối tuần' },
                    'SAVE15K': { discount: 15000, name: 'Tiết kiệm 15K' }
                };

                if (validCodes[promoCode]) {
                    showNotification('Áp dụng mã giảm giá thành công!', 'success');
                    updateTotalPrice(validCodes[promoCode].discount);
                    promoInput.value = '';

                    // Add success animation to applied promo item
                    const appliedItem = document.querySelector(`[data-code="${promoCode}"]`);
                    if (appliedItem) {
                        appliedItem.classList.add('promo_success');
                        setTimeout(() => {
                            appliedItem.classList.remove('promo_success');
                        }, 1000);
                    }
                } else {
                    showNotification('Mã giảm giá không hợp lệ!', 'error');
                }
            }
        });
    }

    // Copy code buttons
    const copyButtons = document.querySelectorAll('.btn_copy_code');
    copyButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            const code = this.getAttribute('data-code');
            promoInput.value = code;

            // Visual feedback
            this.innerHTML = '<i class="fa fa-check"></i>';
            this.style.background = '#27ae60';

            setTimeout(() => {
                this.innerHTML = '<i class="fa fa-copy"></i>';
                this.style.background = '#f39c12';
            }, 1500);

            showNotification(`Đã sao chép mã: ${code}`, 'info');
        });
    });

    // Promo code quick selection (enhanced)
    const promoItems = document.querySelectorAll('.promo_item');
    promoItems.forEach(item => {
        item.addEventListener('click', function() {
            const promoCode = this.getAttribute('data-code');
            promoInput.value = promoCode;

            // Add visual feedback
            promoInput.focus();
            promoInput.style.borderColor = '#f39c12';
            setTimeout(() => {
                promoInput.style.borderColor = '';
            }, 1000);
        });
    });    // Payment button click
    if (paymentBtn) {
        paymentBtn.addEventListener('click', function() {
            const selectedMethod = document.querySelector('input[name="payment_method"]:checked');

            if (!selectedMethod) {
                showNotification('Vui lòng chọn phương thức thanh toán!', 'error');
                return;
            }

            // Show loading state
            this.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Đang xử lý...';
            this.disabled = true;

            // Simulate payment processing
            setTimeout(() => {
                processPayment(selectedMethod.value);
            }, 2000);
        });
    }

    // Form validation for banking payment
    const cardInputs = document.querySelectorAll('#payment_form input');
    cardInputs.forEach(input => {
        input.addEventListener('input', function() {
            validateCardInput(this);
        });
    });

    // Auto-format card number
    const cardNumberInput = document.querySelector('input[placeholder="1234 5678 9012 3456"]');
    if (cardNumberInput) {
        cardNumberInput.addEventListener('input', function() {
            this.value = this.value.replace(/\s/g, '').replace(/(.{4})/g, '$1 ').trim();
        });
    }

    // Auto-format expiry date
    const expiryInput = document.querySelector('input[placeholder="MM/YY"]');
    if (expiryInput) {
        expiryInput.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '').replace(/(.{2})/, '$1/');
        });
    }
});

// Update total price when promo is applied
function updateTotalPrice(discount) {
    const totalElements = document.querySelectorAll('.final_price, .summary_row:last-child span:last-child');
    const currentTotal = 115000; // Base total
    const newTotal = currentTotal - discount;

    totalElements.forEach(element => {
        element.textContent = formatCurrency(newTotal);
    });

    // Update discount display
    const discountElement = document.querySelector('.discount');
    if (discountElement) {
        discountElement.textContent = '-' + formatCurrency(discount);
    }
}

// Format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND'
    }).format(amount).replace('₫', 'đ');
}

// Validate card input
function validateCardInput(input) {
    const value = input.value.trim();

    if (input.placeholder.includes('1234')) {
        // Card number validation
        const isValid = /^[\d\s]{13,19}$/.test(value);
        toggleInputValidation(input, isValid);
    } else if (input.placeholder.includes('MM/YY')) {
        // Expiry date validation
        const isValid = /^(0[1-9]|1[0-2])\/\d{2}$/.test(value);
        toggleInputValidation(input, isValid);
    } else if (input.placeholder.includes('123')) {
        // CVV validation
        const isValid = /^\d{3,4}$/.test(value);
        toggleInputValidation(input, isValid);
    }
}

// Toggle input validation styles
function toggleInputValidation(input, isValid) {
    if (input.value.length > 0) {
        if (isValid) {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
        } else {
            input.classList.remove('is-valid');
            input.classList.add('is-invalid');
        }
    } else {
        input.classList.remove('is-valid', 'is-invalid');
    }
}

// Process payment
function processPayment(method) {
    const methodNames = {
        'momo': 'Ví MoMo',
        'zalopay': 'VCB Digibank',
        'vnpay': 'VietinBank',
        'banking': 'Thẻ ATM/Internet Banking',
        'cash': 'Thanh toán tại chỗ'
    };

    // Simulate different payment flows
    switch(method) {
        case 'momo':
        case 'zalopay':
        case 'vnpay':
            // Redirect to payment gateway
            showNotification(`Đang chuyển đến ${methodNames[method]}...`, 'info');
            setTimeout(() => {
                // Simulate successful payment
                showPaymentSuccess();
            }, 3000);
            break;

        case 'banking':
            // Validate card form
            if (validateCardForm()) {
                showNotification('Đang xử lý thanh toán qua ngân hàng...', 'info');
                setTimeout(() => {
                    showPaymentSuccess();
                }, 3000);
            } else {
                resetPaymentButton();
                showNotification('Vui lòng kiểm tra lại thông tin thẻ!', 'error');
            }
            break;

        case 'cash':
            showNotification('Đặt chỗ thành công! Vui lòng thanh toán tại chỗ.', 'success');
            setTimeout(() => {
                window.location.href = '/dashboard';
            }, 2000);
            break;
    }
}

// Validate card form
function validateCardForm() {
    const requiredInputs = document.querySelectorAll('#payment_form input');
    let isValid = true;

    requiredInputs.forEach(input => {
        if (!input.value.trim()) {
            isValid = false;
            input.classList.add('is-invalid');
        }
    });

    return isValid;
}

// Show payment success
function showPaymentSuccess() {
    showNotification('Thanh toán thành công!', 'success');

    // Create success modal or redirect
    setTimeout(() => {
        if (confirm('Thanh toán thành công! Bạn có muốn xem chi tiết đặt chỗ không?')) {
            window.location.href = '/history';
        } else {
            window.location.href = '/dashboard';
        }
    }, 1500);
}

// Reset payment button
function resetPaymentButton() {
    const paymentBtn = document.getElementById('payment_btn');
    if (paymentBtn) {
        paymentBtn.innerHTML = '<i class="fa fa-lock"></i> Thanh toán an toàn';
        paymentBtn.disabled = false;
    }
}

// Show notification
function showNotification(message, type) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'info'} notification`;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        animation: slideInRight 0.3s ease;
    `;
    notification.innerHTML = `
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <span><i class="fa fa-${type === 'error' ? 'exclamation-circle' : type === 'success' ? 'check-circle' : 'info-circle'}"></i> ${message}</span>
            <button type="button" class="close" style="border: none; background: none; font-size: 18px; margin-left: 10px;">&times;</button>
        </div>
    `;

    document.body.appendChild(notification);

    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);

    // Close button
    notification.querySelector('.close').addEventListener('click', () => {
        notification.remove();
    });
}

// Add CSS for animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .payment_option.selected {
        border-color: #f39c12 !important;
        background: #fff9f0 !important;
    }

    .is-valid {
        border-color: #28a745 !important;
    }

    .is-invalid {
        border-color: #dc3545 !important;
    }
`;
document.head.appendChild(style);
