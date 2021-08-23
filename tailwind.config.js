// tailwind.config.js
module.exports = {
    theme: {
        screens: {
            sm: "640px",
            md: "768px",
            lg: "1366px",
            xl: "1920px"
        },
        fontFamily: {
            display: ["Gilroy", "sans-serif"],
            body: ["Graphik", "sans-serif"]
        },
        borderWidth: {
            default: "1px",
            "0": "0",
            "2": "2px",
            "4": "4px"
        },
        extend: {
            colors: {
                cyan: "#fff"
            },
            spacing: {
                "96": "24rem",
                "128": "32rem"
            }
        }
    }
};
