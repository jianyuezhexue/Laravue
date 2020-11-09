import service from '@/utils/request'

// 创建SysDictionaryDetail
export const createSysDictionaryDetail = (data) => {
    return service({
        url: "/dictionaryDetail",
        method: 'POST',
        data
    })
}


// 删除SysDictionaryDetail
export const deleteSysDictionaryDetail = (id) => {
    return service({
        url: `/dictionaryDetail/${id}`,
        method: 'DELETE',
    })
}

// 更新SysDictionaryDetail
export const updateSysDictionaryDetail = (id, data) => {
    return service({
        url: `/dictionaryDetail/${id}`,
        method: 'put',
        data
    })
}

// 用id查询SysDictionaryDetail
export const findSysDictionaryDetail = (id) => {
    return service({
        url: `/dictionaryDetail/find/${id}`,
        method: 'GET',
    })
}

// 分页获取SysDictionaryDetail列表
export const getSysDictionaryDetailList = (params) => {
    return service({
        url: "/dictionaryDetail/list",
        method: 'GET',
        params
    })
}