const express = require('express');
const router = express.Router();
const fs = require('fs');
const WooCommerceRestApi = require("@woocommerce/woocommerce-rest-api").default;

const api = new WooCommerceRestApi({
  url: "http://external-checkout.local",
  consumerKey: "ck_b1376418b5d727afe13860899673cb11e3499488",
  consumerSecret: "cs_2f34927d33f62ae2faa604fc7d2802295681d8bb",
  version: "wc/v3"
});

// Checkout form
router.get('/checkout', (req, res) => {
    const { product_id } = req.query;
    res.render('checkout', { product_id });
});

// Payment simulation & WooCommerce order creation
router.post('/pay', async (req, res) => {
  const { order_id, email } = req.body;

  try {
    const order = await api.post("orders", {
      payment_method: "bacs",
      payment_method_title: "Bank Transfer",
      set_paid: true,
      billing: {
        first_name: "Rafi",
        last_name: "Alam",
        email: email,
        address_1: "Mirpur",
        city: "Dhaka",
        country: "BD"
      },
      line_items: [
        {
          product_id: parseInt(order_id),
          quantity: 1
        }
      ]
    });

    console.log("WooCommerce Order Created:", order.data);

    // Save locally for admin viewing
    const orders = fs.existsSync('orders.json') ? JSON.parse(fs.readFileSync('orders.json')) : [];
    orders.push(order.data);
    fs.writeFileSync('orders.json', JSON.stringify(orders, null, 2));

    // Callback to WordPress REST API
    const staticToken = "my_super_secret_checkout_token_2025"; // Shared with WP REST API
    await axios.post("http://external-checkout.local/wp-json/custom/v1/confirm-order", {
      order_id,
      email,
      status: "paid"
    }, {
      headers: {
        'Authorization': `Bearer ${staticToken}`
      }
    });

    // Redirect to success
    res.redirect("http://external-checkout.local/checkout-success/");

  } catch (error) {
    console.error("Order creation failed:", error.response?.data || error.message);
    res.status(500).send("Failed to create order.");
  }
});

// Success page
router.get('/checkout-success', (req, res) => {
  res.render('checkout-success', {
    message: "Your order has been placed successfully."
  });
});

router.get('/admin/orders', (req, res) => {
  const orders = fs.existsSync('orders.json') ? JSON.parse(fs.readFileSync('orders.json')) : [];
  res.render('admin-orders', { orders });
});


module.exports = router;
