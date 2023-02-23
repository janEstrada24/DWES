const express = require("express");
const v1MaquinesRouter = require("./v1/routes/maquinesRoutes");
const v1ProductesRouter = require("./v1/routes/productesRoutes");
const v1EstocsRouter = require("./v1/routes/estocsRoutes");
const v1CategoriesRouter = require("./v1/routes/categoriesRoutes");

// Renombrem el swaggerDocs per a evitar confusions
const {swaggerDocs: V1SwaggerDocs} = require("./v1/swagger");

const app = express();
const PORT = process.env.PORT || 3000;

app.use(express.json());
app.use("/api/v1/maquines", v1MaquinesRouter);
app.use("/api/v1/productes", v1ProductesRouter);
app.use("/api/v1/estocs", v1EstocsRouter);
app.use("/api/v1/categories", v1CategoriesRouter);

app.listen(PORT, () => {
  console.log(`🚀 Server listening on port ${PORT}`);
  // Passem el app i el port a la funcio
  V1SwaggerDocs(app, PORT);
});