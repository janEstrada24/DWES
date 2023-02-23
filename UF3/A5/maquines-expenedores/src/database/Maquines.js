const DB = require('./db.json');
const { saveToDatabase } = require('./utils');

const getAllMaquines = (filterParams) => {
    try {
        let maquines = DB.maquines;
        if (filterParams.mode) {
            return DB.maquines.filter((maquina) =>
                maquina.mode.toLowerCase().includes(filterParams.mode)
            );
        }
        return maquines;
    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
};

const getOneMaquina = (maquinaId) => {
    try {
        const maqina = DB.maquines.find((maquina) => maquina.id === maquinaId);
        if (!maquina) {
            throw {
                status: 400,
                message: `Can't find maquina with the id '${maquinaId}'`,
            };
        }

        return maquina;
    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
}

const createOneMaquina = (newMaquina) => {
    try {
        DB.maquines.push(newMaquina);
        saveToDatabase(DB);
        
        return maquina;
    
    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
}

const deleteOneMaquina = (maquinaId) => {
    try {
        const indexForDeletion = DB.maquines.findIndex(
            (maquina) => maquina.id === maquinaId
        );

        if (indexForDeletion === -1) {
            throw {
                status: 400,
                message: `Can't find maquina with the id '${maquinaId}'`,
            };
        }

        DB.maquines.splice(indexForDeletion, 1);
        saveToDatabase(DB);
    
    } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
    }
}


module.exports = { 
    getAllMaquines, 
    getOneMaquina, 
    createOneMaquina,
    deleteOneMaquina 
};