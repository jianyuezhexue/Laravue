import service from '@/utils/request'

// @Summary 用户登录
export const getAuthorityList = (data) => {
    return service({
        url: "/authority/list",
        method: 'GET',
        data
    })
}


// @Summary 删除角色
export const deleteAuthority = (id) => {
    return service({
        url: `/authority/${id}`,
        method: 'DELETE',
    })
}

// @Summary 创建角色
export const createAuthority = (data) => {
    return service({
        url: "/authority",
        method: 'POST',
        data
    })
}

// @Summary 拷贝角色
export const copyAuthority = (data) => {
    return service({
        url: "/authority/copyAuthority",
        method: 'post',
        data
    })
}

// @Summary 设置角色资源权限
export const setDataAuthority = (data) => {
    return service({
        url: "/authority/setDataAuthority",
        method: 'post',
        data
    })
}

// @Summary 修改角色
export const updateAuthority = (id, data) => {
    return service({
        url: `/authority/${id}`,
        method: 'PUT',
        data
    })
}

// 设置角色菜单权限
export const addMenuAuthority = (id, data) => {
    return service({
        url: `/authority/${id}`,
        method: 'PUT',
        data
    })
}