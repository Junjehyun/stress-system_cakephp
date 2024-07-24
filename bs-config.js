module.exports = {
    proxy: "localhost:8765", // CakePHP server&port
    files: [
        "webroot/css/tailwind.css",
        "templates/**/*.php",
        "src/**/*.php"
    ],
    open: true,
    browser: "chrome"
};