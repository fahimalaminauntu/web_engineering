let cartCount = 0;
let totalPrice = 0;
const cartMap = new Map();

const cartIcons = document.querySelectorAll('.add-to-cart');
const cartIcon = document.getElementById('cartIcon');
const cartCountEl = document.getElementById('cartCount');
const drawer = document.getElementById('drawer');
const drawerContent = document.getElementById('drawerContent');
const totalCostEl = document.getElementById('totalCost');
const closeDrawerBtn = document.getElementById('closeDrawerBtn');

cartIcons.forEach(icon => {
    icon.addEventListener('click', e => {
        // Get the product card
        const card = e.target.closest('.productCard');
        const name = card.querySelector('.productName').innerText.trim();
        const priceText = card.querySelector('.newPrice').innerText.trim();
        // Remove $ sign and convert to number
        const price = parseFloat(priceText.replace('$', ''));

        if (cartMap.has(name)) {
            const item = cartMap.get(name);
            item.quantity += 1;
            item.total = item.quantity * price;
        } else {
            cartMap.set(name, { price: price, quantity: 1, total: price });
        }
        updateCart();
    });
});

cartIcon.addEventListener('click', () => {
    drawer.classList.add('open');
    updateCartDrawer();
});

closeDrawerBtn.addEventListener('click', () => {
    drawer.classList.remove('open');
});

function updateCart() {
    cartCount = 0;
    totalPrice = 0;
    cartMap.forEach(item => {
        cartCount += item.quantity;
        totalPrice += item.total;
    });
    cartCountEl.innerText = cartCount;
}

function updateCartDrawer() {
    drawerContent.innerHTML = '';
    if (cartMap.size === 0) {
        drawerContent.innerHTML = '<p>Your cart is empty.</p>';
        totalCostEl.innerText = '';
        return;
    }
    cartMap.forEach((item, name) => {
        const div = document.createElement('div');
        div.style.marginBottom = '10px';
        div.innerHTML = `
            <strong>${name}</strong> - $${item.price.toFixed(2)} × ${item.quantity} = $${item.total.toFixed(2)}
        `;
        drawerContent.appendChild(div);
    });
    totalCostEl.innerText = `Total Cost: $${totalPrice.toFixed(2)}`;
}
