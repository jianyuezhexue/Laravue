import service from '@/utils/request'

// @Tags BusArticle
// @Summary 创建BusArticle
// @Security ApiKeyAuth
// @accept application/json
// @Produce application/json
// @Param data body model.BusArticle true "创建BusArticle"
// @Success 200 {string} string "{"success":true,"data":{},"msg":"获取成功"}"
// @Router /busArticle/createBusArticle [post]
export const createBusArticle = (data) => {
     return service({
         url: "/busArticle/createBusArticle",
         method: 'post',
         data
     })
 }


// @Tags BusArticle
// @Summary 删除BusArticle
// @Security ApiKeyAuth
// @accept application/json
// @Produce application/json
// @Param data body model.BusArticle true "删除BusArticle"
// @Success 200 {string} string "{"success":true,"data":{},"msg":"删除成功"}"
// @Router /busArticle/deleteBusArticle [delete]
 export const deleteBusArticle = (data) => {
     return service({
         url: "/busArticle/deleteBusArticle",
         method: 'delete',
         data
     })
 }

// @Tags BusArticle
// @Summary 删除BusArticle
// @Security ApiKeyAuth
// @accept application/json
// @Produce application/json
// @Param data body request.IdsReq true "批量删除BusArticle"
// @Success 200 {string} string "{"success":true,"data":{},"msg":"删除成功"}"
// @Router /busArticle/deleteBusArticle [delete]
 export const deleteBusArticleByIds = (data) => {
     return service({
         url: "/busArticle/deleteBusArticleByIds",
         method: 'delete',
         data
     })
 }

// @Tags BusArticle
// @Summary 更新BusArticle
// @Security ApiKeyAuth
// @accept application/json
// @Produce application/json
// @Param data body model.BusArticle true "更新BusArticle"
// @Success 200 {string} string "{"success":true,"data":{},"msg":"更新成功"}"
// @Router /busArticle/updateBusArticle [put]
 export const updateBusArticle = (data) => {
     return service({
         url: "/busArticle/updateBusArticle",
         method: 'put',
         data
     })
 }


// @Tags BusArticle
// @Summary 用id查询BusArticle
// @Security ApiKeyAuth
// @accept application/json
// @Produce application/json
// @Param data body model.BusArticle true "用id查询BusArticle"
// @Success 200 {string} string "{"success":true,"data":{},"msg":"查询成功"}"
// @Router /busArticle/findBusArticle [get]
 export const findBusArticle = (params) => {
     return service({
         url: "/busArticle/findBusArticle",
         method: 'get',
         params
     })
 }


// @Tags BusArticle
// @Summary 分页获取BusArticle列表
// @Security ApiKeyAuth
// @accept application/json
// @Produce application/json
// @Param data body request.PageInfo true "分页获取BusArticle列表"
// @Success 200 {string} string "{"success":true,"data":{},"msg":"获取成功"}"
// @Router /busArticle/getBusArticleList [get]
 export const getBusArticleList = (params) => {
     return service({
         url: "/busArticle/getBusArticleList",
         method: 'get',
         params
     })
 }