import service from '@/utils/request'

// @Summary 用户登录 获取动态路由
// @Produce  application/json
// @Param 可以什么都不填 调一下即可
// @Router /menu [GET]
export const asyncMenu = () => {
    return service({
        url: "/menu/",
        method: 'GET',
    })
}

// @Summary 获取menu列表
// @Produce  application/json
// @Param {
//  page     int
//	pageSize int
// }
// @Router /menu/getMenuList [GET]
export const getMenuList = (data) => {
    return service({
        url: "/menu/list",
        method: 'GET',
        data
    })
}


// @Summary 新增基础menu
// @Produce  application/json
// @Param menu Object
// @Router /menu/getMenuList [POST]
export const addBaseMenu = (data) => {
    return service({
        url: "/menu",
        method: 'POST',
        data
    })
}

// @Summary 获取基础路由列表
// @Produce  application/json
// @Param 可以什么都不填 调一下即可
// @Router /menu/getBaseMenuTree [post]
export const getBaseMenuTree = () => {
    return service({
        url: "/menu",
        method: 'GET',
    })
}

// @Summary 添加用户menu关联关系
// @Produce  application/json
// @Param menus Object authorityId string
// @Router /menu/getMenuList [post]
export const addMenuAuthority = (data) => {
    return service({
        url: "/menu/addMenuAuthority",
        method: 'post',
        data
    })
}

// @Summary 获取用户menu关联关系
// @Produce  application/json
// @Param authorityId string
// @Router /menu/getMenuAuthority [post]
export const getMenuAuthority = (data) => {
    return service({
        url: "/menu/getMenuAuthority",
        method: 'post',
        data
    })
}

// @Summary 删除菜单
// @Produce  application/json
// @Param ID float64
// @Router /menu/deleteBaseMenu [DELETE]
export const deleteBaseMenu = (id) => {
    return service({
        url: `/menu/${id}`,
        method: 'DELETE',
    })
}


// @Summary 修改menu列表
// @Produce  application/json
// @Param menu Object
// @Router /menu/updateBaseMenu [post]
export const updateBaseMenu = (id, data) => {
    return service({
        url: `/menu/${id}`,
        method: 'PUT',
        data
    })
}


// @Tags menu
// @Summary 根据id获取菜单
// @Security ApiKeyAuth
// @accept application/json
// @Produce application/json
// @Param data body api.GetById true "根据id获取菜单"
// @Success 200 {string} json "{"success":true,"data":{},"msg":"获取成功"}"
// @Router /menu/getBaseMenuById [GET]
export const getBaseMenuById = (id) => {
    return service({
        url: `/menu/find/${id}`,
        method: 'GET',
    })
}