import { getDict } from "@/utils/dictionary";
export default {
    data() {
        return {
            page: 1,
            total: 10,
            pageSize: 10,
            tableData: [],
            searchInfo: {}
        }
    },
    methods: {
        filterDict(value, type) {
            const rowLabel = this[type + "Options"] && this[type + "Options"].filter(item => item.value == value)
            return rowLabel && rowLabel[0] && rowLabel[0].label
        },
        async getDict(type) {
            const dicts = await getDict(type)
            this[type + "Options"] = dicts
        },
        handleSizeChange(val) {
            this.pageSize = val
            this.getTableData()
        },
        handleCurrentChange(val) {
            this.page = val
            this.getTableData()
        },
        async getTableData(page = this.page, pageSize = this.pageSize) {
            let search = {}
            for (let key in this.searchInfo) {
                if (this.searchInfo[key]) search[key] = this.searchInfo[key]
            }
            const table = await this.listApi({ page, pageSize, ...search })
            this.tableData = table.data.list
            this.total = table.data.total
            this.page = table.data.page
            this.pageSize = table.data.pageSize
        }
    }
}