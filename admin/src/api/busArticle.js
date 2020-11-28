import service from '@/utils/request'

// 创建BusArticle
export const createBusArticle = (data) => {
    return service({
        url: "/busArticle",
        method: 'POST',
        data
    })
}

// 更具ID或IDS 删除BusArticle
export const deleteBusArticle = (id) => {
    return service({
        url: `/busArticle/${id}`,
        method: 'DELETE',
    })
}

// 更新BusArticle
export const updateBusArticle = (id, data) => {
    return service({
        url: `/busArticle/${id}`,
        method: 'PUT',
        data
    })
}

// 根据idBusArticle
export const findBusArticle = (type) => {
    return service({
        url: `/busArticle/find/${type}`,
        method: 'GET',
    })
}

// 分页获取BusArticle列表
export const getBusArticleList = (params) => {
    return service({
        url: "/busArticle/list",
        method: 'GET',
        params
    })
}