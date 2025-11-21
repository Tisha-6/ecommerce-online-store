const PRODUCTS = {
    1: {
        id: 1,
        name: "Jivika Fabulous Kurta",
        img: "./images/Women/Kurta_sets/1.webp",
        price: 520,
        oldPrice: 629,
        rating: "★★★★☆ (4.0)",
        fabric: "Cotton",
        color: "Blue",
        category: "kurta"
    },
    2: {
        id: 2,
        name: "Trendy Attractive Kurtis",
        img: "./images/Women/Kurta_sets/2.webp",
        price: 383,
        oldPrice: 429,
        rating: "★★★★☆ (4.0)",
        fabric: "Cotton",
        color: "Grey",
        category: "kurta"
    },

    // ⭐ ADD ALL 100 PRODUCTS HERE  
    // Sarees, bags, lehenga, shoes, kids items — everything
};

const query = new URLSearchParams(window.location.search);
const id = query.get("id");
const product = PRODUCTS[id];

document.getElementById("productImg").src = product.img;
document.getElementById("productName").textContent = product.name;
document.getElementById("productPrice").textContent = "₹" + product.price;
document.getElementById("productOldPrice").textContent = "₹" + product.oldPrice;
document.getElementById("productRating").textContent = product.rating;
document.getElementById("productFabric").textContent = "Fabric: " + product.fabric;
document.getElementById("productColor").textContent = "Color: " + product.color;

