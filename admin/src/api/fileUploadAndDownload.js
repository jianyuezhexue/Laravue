import service from '@/utils/request'
// @Summary 分页文件列表
export const getFileList = (data) => {
    return service({
        url: "/file/list",
        method: "GET",
        data
    })
}

// @Summary 删除文件
export const deleteFile = (data) => {
    return service({
        url: "/fileUploadAndDownload/deleteFile",
        method: "POST",
        data
    })
}