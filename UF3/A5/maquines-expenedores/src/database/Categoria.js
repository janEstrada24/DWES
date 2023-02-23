const DB = require('./db.json');
const { saveToDatabase } = require('./utils');

const getAllCategories = (filterParams) => {
    try {
        let categories = DB.categories;
        if (filterParams.mode) {
            return DB.categories.filter((categoria) =>
                categoria.mode.toLowerCase().includes(filterParams.mode)
            );
        }
        return categories;
    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
};

const getOneCategoria = (categoriaId) => {
    try {
        const categoria = DB.categories.find((categoria) => categoria.id === categoriaId);
        if (!categoria) {
            throw {
                status: 400,
                message: `Can't find categoria with the id '${categoriaId}'`,
            };
        }

        return categoria;
    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
};

const createOneCategoria = (newCategoria) => {
    try {
        const isAlreadyAdded = 
            DB.categories.findIndex((categoria) => categoria.nom === newCategoria.nom) > -1;  
        
        if(isAlreadyAdded) {
            throw {
                status: 400,
                message: `Categoria with nom '${newCategoria.nom}' already exists`,
            };
        }

        DB.categories.push(newCategoria);
        saveToDatabase(DB);

        return newCategoria;

    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
};

const updateOneCategoria = (categoriaId, changes) => {
    try {
        const isAlreadyAdded =
            DB.categories.findIndex((categoria) => categoria.nom === changes.nom) > -1;

        if (isAlreadyAdded) {
            throw {
                status: 400,
                message: `Categoria with nom '${changes.nom}' already exists`,
            };
        }

        const indexForUpdate = DB.categories.findIndex(
            (categoria) => categoria.id === categoriaId
        );

        if (indexForUpdate === -1) {
            throw {
                status: 400,
                message: `Can't find categoria with the id '${categoriaId}'`,
            };
        }

        const updatedCategoria = {
            ...DB.categories[indexForUpdate],
            ...changes,
            updatedAt: new Date().toLocaleString("en-US", { timeZone: "UTC" }),
        }

        DB.categories[indexForUpdate] = updatedCategoria;
        saveToDatabase(DB);

        return updatedCategoria;

    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
};

const deleteOneCategoria = (categoriaId) => {
    try {
        const indexForDeletion = DB.categories.findIndex(
            (categoria) => categoria.id === categoriaId
        );

        if (indexForDeletion === -1) {
            throw {
                status: 400,
                message: `Can't find categoria with the id '${categoriaId}'`,
            };
        }

        DB.categories.splice(indexForDeletion, 1);
        saveToDatabase(DB);

    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
};

module.exports = {
    getAllCategories,
    getOneCategoria,
    createOneCategoria,
    updateOneCategoria,
    deleteOneCategoria,
};