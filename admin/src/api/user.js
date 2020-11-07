import service from '@/utils/request'

// 用户登录
export const login = (data) => {
    return service({
        url: "/user/login",
        method: 'POST',
        data: data
    })
}

// 用户注销
export const loginOut = (data) => {
    return service({
        url: "/user/loginOut",
        method: 'POST',
        data: data
    })
}

// 获取验证码
export const captcha = (data) => {
    return service({
        url: "/base/captcha",
        method: 'POST',
        data: data
    })
}

// 用户注册
export const register = (data) => {
    return service({
        url: "/user/register",
        method: 'POST',
        data: data
    })
}
// 修改密码
export const changePassword = (data) => {
    return service({
        url: "/user/changePassword",
        method: 'POST',
        data: data
    })
}
// 分页获取用户列表
export const getUserList = (data) => {
    return service({
        url: "/user/list",
        method: 'POST',
        data: data
    })
}


// 设置用户权限
export const setUserAuthority = (uuid, data) => {
    return service({
        url: `/user/setAuthority/${uuid}`,
        method: 'PUT',
        data: data
    })
}


// 删除用户
export const deleteUser = (id) => {
    return service({
        url: `/user/${id}`,
        method: 'DELETE',
    })
}

// 设置用户信息
export const setUserInfo = (data) => {
    return service({
        url: "/user/setUserInfo",
        method: 'put',
        data: data
    })
}
