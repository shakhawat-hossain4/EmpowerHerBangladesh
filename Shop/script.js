// JavaScript code for dynamic functionality
document.addEventListener("DOMContentLoaded", function () {
    // Sample product data
    const products = [
        {
            name: "Lehenga",
            price: "5000 TK",
            description: "Traditional Bengali outfit for women.",
            image: "lehenga.jpg"
        },
        {
            name: "Tangail Saree",
            price: "7000 TK",
            description: "Elegant saree with Tangail design.",
            image: "Tangail Saree.jpg"
        },
        {
            name: "Kurti",
            price: "2000 TK",
            description: "Casual and comfortable women's attire.",
            image: "Kurti.jpg"
        },
        {
            name: "Salwar Kameez",
            price: "3000 TK",
            description: "Traditional South Asian outfit for women.",
            image: "Salwar Kameez.jpg"
        },
        {
            name: "Anarkali",
            price: "4000 TK",
            description: "Traditional Indian dress with flare.",
            image: "Anarkali.jpg"
        },
        {
            name: "Fotua",
            price: "3500 TK",
            description: "Casual Bengali attire for women.",
            image: "Fotua.jpg"
        },
        {
            name: "Jamdani Saree",
            price: "6000 TK",
            description: "Handwoven saree with intricate designs.",
            image: "Jamdani Saree.jpg"
        },
        {
            name: "Sharara",
            price: "4500 TK",
            description: "Elegant ethnic wear for special occasions.",
            image: "Sharara.jpg"
        },
        {
            name: "Tops",
            price: "500 TK",
            description: "Stylish tops for women.",
            image: "Tops.jpg"
        },
        {
            name: "Abaya Borka",
            price: "1500 TK",
            description: "Modest Islamic clothing for women.",
            image: "abaya.webp"
        },
        // Add more products here
    ];

    const productList = document.getElementById("product-list");
    const searchInput = document.getElementById("search-input");

    // Function to display products based on search criteria
    function displayProducts(productsToDisplay) {
        productList.innerHTML = "";

        productsToDisplay.forEach(product => {
            const productItem = document.createElement("div");
            productItem.className = "product-item";
            productItem.innerHTML = `
                <img src="${product.image}" alt="${product.name}" class="product-image">
                <div class="product-details">
                    <h3>${product.name}</h3>
                    <p>Price: ${product.price}</p>
                    <p>${product.description}</p>
                    <button class="add-to-cart-button">Add to Cart</button>
                    <button class="buy-button">Buy</button>
                </div>
            `;
            productList.appendChild(productItem);
        });
    }

    // Function to filter products based on search criteria
    function filterProducts() {
        const searchTerm = searchInput.value.toLowerCase();

        const filteredProducts = products.filter(product => {
            const productName = product.name.toLowerCase();

            return productName.includes(searchTerm);
        });

        displayProducts(filteredProducts);
    }

    // Add event listener to the search input
    searchInput.addEventListener("input", filterProducts);

    // Initial display of all products
    displayProducts(products);
});
