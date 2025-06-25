const n = parseInt(prompt("Enter the number of Fibonacci terms:"));

function generateFibonacci(n) {
    const series = [];
    for (let i = 0; i < n; i++) {
        if (i === 0) series.push(0);
        else if (i === 1) series.push(1);
        else series.push(series[i - 1] + series[i - 2]);
    }
    return series;
}

const container = document.getElementById('container');
const fibSeries = generateFibonacci(n);

fibSeries.forEach((num, index) => {
    const box = document.createElement('div');
    box.classList.add('box');
    box.classList.add(index % 2 === 0 ? 'blue' : 'green');
    box.textContent = num;
    container.appendChild(box);
});