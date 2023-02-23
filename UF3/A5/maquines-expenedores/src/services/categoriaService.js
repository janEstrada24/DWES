// Renombrem el mètode perquè no es confongui amb el mètode de la classe
const {v4: uuid} = require('uuid');

const Categoria = require('../database/Categoria.js');

const getAllCategories = (filterParams) => {
    try {
        const allCategories = Categoria.getAllCategories(filterParams);
        return allCategories;
    } catch (error) {
        throw error;
    }
};

const getOneCategoria = (categoriaId) => {
    try {
        const categoria = Categoria.getOneCategoria(categoriaId);
        return categoria;
    }
    catch (error) {
        throw error;
    }
};

const createOneCategoria = (newCategoria) => {
    const categoriaToInsert = {
        // Creem un nou objecte amb les dades que ens passen
        ...newCategoria,

        // Afegim el id de forma aleatòria
        id: uuid(),
        
        createdAt: new Date().toLocaleString("en-US", { timeZone: "UTC" }),
        updatedAt: new Date().toLocaleString("en-US", { timeZone: "UTC" }),
    };

    try {
        const categoria = Categoria.createOneCategoria(categoriaToInsert);
        return categoria;
    } catch (error) {
        throw error;
    }
}

const updateOneCategoria = (categoriaId, changes) => {
    try {
        const updatedCategoria = Categoria.updateOneCategoria(categoriaId, changes);
        return updatedCategoria;
    } catch (error) {
        throw error;
    }
};

const deleteOneCategoria = (categoriaId) => {
    try {
        const categoria = Categoria.deleteOneCategoria(categoriaId);
        return categoria;
    } catch (error) {
        throw error;
    }
}

module.exports = {
    getAllCategories,
    getOneCategoria,
    createOneCategoria,
    updateOneCategoria,
    deleteOneCategoria,
};