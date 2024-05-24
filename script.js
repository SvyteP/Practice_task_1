function formatCardNumber(input) {
    // Remove any non-digit characters
    let value = input.value.replace(/\D/g, '');

    // Add a space every 4 digits
    let formattedValue = value.replace(/(\d{4})/g, '$1 ').trim();

    // Set the formatted value back to the input field
    input.value = formattedValue;
}

