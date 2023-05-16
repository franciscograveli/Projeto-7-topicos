document.getElementById('fat').addEventListener('submit', calculateFactorial);

async function calculateFactorial(event) {
    event.preventDefault();

    let number = document.getElementById('numberfat').value;
    if (number === '') {
        alert('Please enter a number');
        return;
    }

    let response = await fetch('/assets/php/controller.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'number=' + number
    });

    if (response.ok) {
        let result = await response.text();
        document.getElementById('result').innerText = 'The factorial is ' + result;
    } else {
        alert('HTTP-Error: ' + response.status);
    }
}