import service from '@/utils/request'

// 用户登录 获取动态路由
export const asyncMenu = () => {
    return service({
        url: "/menu/async",
        method: 'GET',
    })
}

// 获取menu列表
export const getMenuList = (data) => {
    return service({
        url: "/menu/list",
        method: 'GET',
        data
    })
}

// 新增基础menu
export const addBaseMenu = (data) => {
    return service({
        url: "/menu",
        method: 'POST',
        data
    })
}

// 获取基础路由列表
export const getBaseMenuTree = () => {
    return service({
        url: "/menu",
        method: 'GET',
    })
}

// 添加用户menu关联关系
export const addMenuAuthority = (data) => {
    return service({
        url: "/menu/addMenuAuthority",
        method: 'POST',
        data
    })
}

// 获取用户menu关联关系
export const getMenuAuthority = (data) => {
    return service({
        url: "/menu/getMenuAuthority",
        method: 'POST',
        data
    })
}

// 删除菜单
export const deleteBaseMenu = (id) => {
    return service({
        url: `/menu/${id}`,
        method: 'DELETE',
    })
}

// 修改menu列表
export const updateBaseMenu = (id, data) => {
    return service({
        url: `/menu/${id}`,
        method: 'PUT',
        data
    })
}

// 根据id获取菜单
export const getBaseMenuById = (id) => {
    return service({
        url: `/menu/find/${id}`,
        method: 'GET',
    })
}