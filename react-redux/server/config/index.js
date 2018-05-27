/**
 * Created by hoangtuannhan on 27/05/2018.
 */
import DotENV from 'dotenv';
import DB from './config.json';


DotENV.config();

const env = process.env.NODE_ENV;

const db = DB[env];

module.exports = {
    env: env,
    port: process.env.PORT,
    expireTime: process.env.EXPIRE_TIME,
    db: {
        username: db.username,
        password: db.password,
        database: db.database,
        host: db.port,
        dialect: db.dialect
    }
};