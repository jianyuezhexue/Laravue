import service from '@/utils/request'

// 创建{{Template}}
export const create{{Template}} = (data) => {
    return service({
        url: "/{{apiName}}",
        method: 'POST',
        data
    })
}

// 更具ID或IDS 删除{{Template}}
export const delete{{Template}} = (id) => {
    return service({
        url: `/{{apiName}}/${id}`,
        method: 'DELETE',
    })
}

// 更新{{Template}}
export const update{{Template}} = (id, data) => {
    return service({
        url: `/{{apiName}}/${id}`,
        method: 'PUT',
        data
    })
}

// 根据id{{Template}}
export const find{{Template}} = (type) => {
    return service({
        url: `/{{apiName}}/find/${type}`,
        method: 'GET',
    })
}

// 分页获取{{Template}}列表
export const get{{Template}}List = (params) => {
    return service({
        url: "/{{apiName}}/list",
        method: 'GET',
        params
    })
}