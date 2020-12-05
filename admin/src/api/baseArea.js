import service from '@/utils/request'

// 创建BaseArea
export const createBaseArea = (data) => {
    return service({
        url: "/baseArea",
        method: 'POST',
        data
    })
}

// 更具ID或IDS 删除BaseArea
export const deleteBaseArea = (id) => {
    return service({
        url: `/baseArea/${id}`,
        method: 'DELETE',
    })
}

// 更新BaseArea
export const updateBaseArea = (id, data) => {
    return service({
        url: `/baseArea/${id}`,
        method: 'PUT',
        data
    })
}

// 根据idBaseArea
export const findBaseArea = (type) => {
    return service({
        url: `/baseArea/find/${type}`,
        method: 'GET',
    })
}

// 分页获取BaseArea列表
export const getBaseAreaList = (params) => {
    return service({
        url: "/baseArea/list",
        method: 'GET',
        params
    })
}