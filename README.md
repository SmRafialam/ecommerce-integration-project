# E-commerce Integration Project (Node.js + WordPress WooCommerce)

This project integrates a custom **Node.js checkout backend** with a **WordPress WooCommerce** frontend using a custom plugin. Users click a custom "Proceed to Checkout" button from the WooCommerce cart page, which redirects them to a Node.js checkout page. After a simulated payment, the Node.js backend sends a secure callback to WordPress, where a WooCommerce order is created programmatically.

---

## 🔧 Project Structure

ecommerce-integration-project/
├── node-backend/ # Node.js Express server
├── wp-custom-plugin/ # Custom WordPress plugin to handle callback and Woo integration
└── README.md

---

## 🚀 Features

- Custom **"Proceed to Checkout"** button in WooCommerce cart
- Redirects to **Node.js backend** checkout route with cart/order details
- Simulated payment on Node.js side
- Secure callback from Node.js to WordPress via REST API
- WordPress plugin receives the callback and creates a **WooCommerce order**
- Uses **static token** or **HMAC signature** to validate callback request

---

## 📦 Node.js Backend

### Location
`/node-backend`

### Commands
```bash
cd node-backend
npm install
node index.js
