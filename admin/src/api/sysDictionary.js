import service from '@/utils/request'

// 创建SysDictionary
export const createSysDictionary = (data) => {
    return service({
        url: "/dictionary",
        method: 'POST',
        data
    })
}

// 删除SysDictionary
export const deleteSysDictionary = (id) => {
    return service({
        url: `/dictionary/${id}`,
        method: 'DELETE',
    })
}

// 更新SysDictionary
export const updateSysDictionary = (id, data) => {
    return service({
        url: `/dictionary/${id}`,
        method: 'PUT',
        data
    })
}

// 用id或者type查询SysDictionary
export const findSysDictionary = (type) => {
    return service({
        url: `/dictionary/find/${type}`,
        method: 'GET',
    })
}

// 分页获取SysDictionary列表
export const getSysDictionaryList = (params) => {
    return service({
        url: "/dictionary/list",
        method: 'GET',
        params
    })
}