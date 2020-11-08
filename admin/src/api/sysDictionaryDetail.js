import service from '@/utils/request'

// @Summary 创建SysDictionaryDetail
export const createSysDictionaryDetail = (data) => {
     return service({
         url: "/sysDictionaryDetail/createSysDictionaryDetail",
         method: 'POST',
         data
     })
 }


// @Summary 删除SysDictionaryDetail
 export const deleteSysDictionaryDetail = (data) => {
     return service({
         url: "/sysDictionaryDetail/deleteSysDictionaryDetail",
         method: 'DELETE',
         data
     })
 }

// @Summary 更新SysDictionaryDetail
 export const updateSysDictionaryDetail = (data) => {
     return service({
         url: "/sysDictionaryDetail/updateSysDictionaryDetail",
         method: 'put',
         data
     })
 }

// @Summary 用id查询SysDictionaryDetail
 export const findSysDictionaryDetail = (params) => {
     return service({
         url: "/sysDictionaryDetail/findSysDictionaryDetail",
         method: 'GET',
         params
     })
 }

// @Summary 分页获取SysDictionaryDetail列表
 export const getSysDictionaryDetailList = (params) => {
     return service({
         url: "/sysDictionaryDetail/getSysDictionaryDetailList",
         method: 'GET',
         params
     })
 }