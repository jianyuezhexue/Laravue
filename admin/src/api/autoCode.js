import service from '@/utils/request'

// 分页获取角色列表
export const createTemp = (data) => {
    return service({
        url: "/autoCode/createTemp",
        method: 'POST',
        data,
        responseType: 'blob'
    })
}


// 获取当前所有数据库
export const getDB = () => {
    return service({
        url: "/autoCode/getDB",
        method: 'GET',
    })
}



// 获取当前数据库所有表
export const getTable = (params) => {
    return service({
        url: "/autoCode/getTables",
        method: 'GET',
        params,
    })
}

// 获取当前数据库所有表
export const getColume = (params) => {
    return service({
        url: "/autoCode/getColume",
        method: 'GET',
        params,
    })
}