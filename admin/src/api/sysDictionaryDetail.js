import service from '@/utils/request'

// 创建SysDictionaryDetail
export const createSysDictionaryDetail = (data) => {
     return service({
         url: "/dictionaryDetail/createSysDictionaryDetail",
         method: 'POST',
         data
     })
 }


// 删除SysDictionaryDetail
 export const deleteSysDictionaryDetail = (data) => {
     return service({
         url: "/dictionaryDetail/deleteSysDictionaryDetail",
         method: 'DELETE',
         data
     })
 }

// 更新SysDictionaryDetail
 export const updateSysDictionaryDetail = (data) => {
     return service({
         url: "/dictionaryDetail/updateSysDictionaryDetail",
         method: 'put',
         data
     })
 }

// 用id查询SysDictionaryDetail
 export const findSysDictionaryDetail = (params) => {
     return service({
         url: "/dictionaryDetail/findSysDictionaryDetail",
         method: 'GET',
         params
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