<template>
  <div>
    <div class="search-term">
      <el-form :inline="true" :model="searchInfo" class="demo-form-inline">          
        <el-form-item>
          <el-button @click="onSubmit" type="primary">查询</el-button>
        </el-form-item>
        <el-form-item>
          <el-button @click="openDialog" type="primary">新增</el-button>
        </el-form-item>
        <el-form-item>
          <el-popover placement="top" v-model="deleteVisible" width="160">
            <p>确定要删除吗？</p>
              <div style="text-align: right; margin: 0">
                <el-button @click="deleteVisible = false" size="mini" type="text">取消</el-button>
                <el-button @click="onDelete" size="mini" type="primary">确定</el-button>
              </div>
            <el-button icon="el-icon-delete" size="mini" slot="reference" type="danger">批量删除</el-button>
          </el-popover>
        </el-form-item>
      </el-form>
    </div>
    <el-table
      :data="tableData"
      @selection-change="handleSelectionChange"
      border
      ref="multipleTable"
      stripe
      style="width: 100%"
      tooltip-effect="dark"
    >
    <el-table-column type="selection" width="55"></el-table-column>
    <el-table-column label="日期" width="180">
         <template slot-scope="scope">{{scope.row.CreatedAt|formatDate}}</template>
    </el-table-column>
    
    <el-table-column label="文章标题" prop="title" width="120"></el-table-column> 
    
    <el-table-column label="文章描述" prop="desc" width="120"></el-table-column> 
    
    <el-table-column label="作者" width="120">
         <template slot-scope="scope">{{scope.row.author|formatAuthor}}</template>
    </el-table-column> 
    
    <el-table-column label="文章内容" prop="content" width="120"></el-table-column> 
    
    <!-- <el-table-column label="文章标签" prop="tagNames" width="120"></el-table-column> -->
    <el-table-column label="文章标签" width="120">
         <template slot-scope="scope">{{scope.row.tag|formatTag}}</template>
    </el-table-column>  
    
      <el-table-column label="按钮组">
        <template slot-scope="scope">
          <el-button @click="updateBusArticle(scope.row)" size="small" type="primary">变更</el-button>
          <el-popover placement="top" width="160" v-model="scope.row.visible">
            <p>确定要删除吗？</p>
            <div style="text-align: right; margin: 0">
              <el-button size="mini" type="text" @click="scope.row.visible = false">取消</el-button>
              <el-button type="primary" size="mini" @click="deleteBusArticle(scope.row)">确定</el-button>
            </div>
            <el-button type="danger" icon="el-icon-delete" size="mini" slot="reference">删除</el-button>
          </el-popover>
        </template>
      </el-table-column>
    </el-table>

    <el-pagination
      :current-page="page"
      :page-size="pageSize"
      :page-sizes="[10, 30, 50, 100]"
      :style="{float:'right',padding:'20px'}"
      :total="total"
      @current-change="handleCurrentChange"
      @size-change="handleSizeChange"
      layout="total, sizes, prev, pager, next, jumper"
    ></el-pagination>

    <el-dialog :before-close="closeDialog" :visible.sync="dialogFormVisible" title="表单操作">
      <!-- 此处请使用表单生成器生成form填充 表单默认绑定 formData 如手动修改过请自行修改key -->
      <formTable :formData="formData" :authorOptions="authorOptions" :tagOptions="tagOptions"></formTable>
      <div class="dialog-footer" slot="footer">
        <el-button @click="closeDialog">取 消</el-button>
        <el-button @click="enterDialog" type="primary">确 定</el-button>
      </div>
    </el-dialog>
  </div>
</template>

<script>
import {
    createBusArticle,
    deleteBusArticle,
    deleteBusArticleByIds,
    updateBusArticle,
    findBusArticle,
    getBusArticleList
} from "@/api/busArticle";  //  此处请自行替换地址
import { formatTimeToStr } from "@/utils/data";
import infoList from "@/components/mixins/infoList";
import formTable from "./formTable.vue";
var that;
export default {
  name: "BusArticle",
  mixins: [infoList],
  components: {formTable},
  data() {
    return {
      listApi: getBusArticleList,
      dialogFormVisible: false,
      visible: false,
      type: "",
      deleteVisible: false,
      multipleSelection: [],
      formData: {
        title:null,desc:null,author:null,content:null,tag:[],
      }, 
      authorOptions: [
        {
          label: "选项一",
          value: 1,
        },
        {
          label: "选项二",
          value: 2,
        },
      ],
      tagOptions: [
        {
          label: "选项一",
          value: 1,
        },
        {
          label: "选项二",
          value: 2,
        },
      ],
    };
  },
  filters: {
    formatDate: function(time) {
      if (time != null && time != "") {
        var date = new Date(time);
        return formatTimeToStr(date, "yyyy-MM-dd hh:mm:ss");
      } else {
        return "";
      }
    },
    formatBoolean: function(bool) {
      if (bool != null) {
        return bool ? "是" :"否";
      } else {
        return "";
      }
    },
    formatAuthor:function(id){
      let author = that.authorOptions.find(item => item.value == id)
      return author.label
    },
    formatTag:function(str){
      let ids = JSON.parse(str)
      let tags = that.tagOptions.filter(item => ids.indexOf(item.value) != -1)
      let tagNames = ""
      tags.forEach(item => {
        tagNames += item.label + "," 
      })
      return tagNames.substring(0,tagNames.length-1)
    },
  },
  methods: {
      //条件搜索前端看此方法
      onSubmit() {
        this.page = 1
        this.pageSize = 10         
        this.getTableData()
      },
      handleSelectionChange(val) {
        this.multipleSelection = val
      },
      async onDelete() {
        const ids = []
        this.multipleSelection &&
          this.multipleSelection.map(item => {
            ids.push(item.ID)
          })
        const res = await deleteBusArticleByIds({ ids })
        if (res.code == 200) {
          this.$message({
            type: 'success',
            message: '删除成功'
          })
          this.deleteVisible = false
          this.getTableData()
        }
      },
    async updateBusArticle(row) {
      const res = await findBusArticle({ ID: row.ID });
      this.type = "update";
      if (res.code == 200) {
        this.formData = res.data.rebusArticle;
        this.dialogFormVisible = true;
      }
    },
    closeDialog() {
      this.dialogFormVisible = false;
      this.formData = {
          title:null,
          desc:null,
          author:null,
          content:null,
          tag:[],
      };
    },
    async deleteBusArticle(row) {
      this.visible = false;
      const res = await deleteBusArticle({ ID: row.ID });
      if (res.code == 200) {
        this.$message({
          type: "success",
          message: "删除成功"
        });
        this.getTableData();
      }
    },
    async enterDialog() {
      this.formData.tag = JSON.stringify(this.formData.tag);
      let res;
      switch (this.type) {
        case "create":
          res = await createBusArticle(this.formData);
          break;
        case "update":
          res = await updateBusArticle(this.formData);
          break;
        default:
          res = await createBusArticle(this.formData);
          break;
      }
      if (res.code == 200) {
        this.$message({
          type:"success",
          message:"创建/更改成功"
        })
        this.closeDialog();
        this.getTableData();
      }
    },
    openDialog() {
      this.type = "create";
      this.dialogFormVisible = true;
    }
  },
  async created() {
    that = this;
    await this.getDict("author");
    await this.getDict("tag");
    await this.getTableData();
  }
};
</script>

<style>
</style>