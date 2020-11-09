import service from '@/utils/request'

// @Summary 删除SysOperationRecord
export const deleteSysOperationRecord = (id) => {
    return service({
        url: `/accessLog/${id}`,
        method: 'DELETE',
    })
}

// @Summary 批量删除SysOperationRecord
export const deleteSysOperationRecordByIds = (id) => {
    return service({
        url: `/accessLog/${id}`,
        method: 'DELETE',
    })
}

// @Summary 分页获取SysOperationRecord列表
export const getSysOperationRecordList = (params) => {
    return service({
        url: "/accessLog/list",
        method: 'GET',
        params
    })
}