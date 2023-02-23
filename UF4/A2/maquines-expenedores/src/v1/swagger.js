const swaggerJSDoc = require("swagger-jsdoc");
const swaggerUi = require("swagger-ui-express");

// Metadades de la API
const options = {
    definition: {
        openapi: "3.0.0",
        info: {
            title: "API de maquines expenedores",
            version: "1.0.0",
        },
    },
    apis: ["src/v1/routes/*.js", "src/database/*.js"],
};


// Documentacio en format JSON
const swaggerSpec = swaggerJSDoc(options);

// Funcio per a configurar la documentacio 
const swaggerDocs = (app, port) => {
    app.use("/api/v1/docs", swaggerUi.serve, swaggerUi.setup(swaggerSpec));
    app.get("/api/v1/docs.json", (req, res) => {
        res.setHeader("Content-Type", "application/json");
        res.send(swaggerSpec);
    });

    console.log(`Version 1 Docs are available at http://localhost:${port}/api/v1/docs/`);
}

module.exports = { swaggerDocs };
