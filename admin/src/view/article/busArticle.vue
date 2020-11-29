<template>
  <div>
    <!-- 查询表单开始 -->
    <div class="search-term">
      <el-form :inline="true" :model="searchInfo" class="demo-form-inline">
        <el-form-item>
          <el-input v-model="searchInfo.title" placeholder="文章标题" clearable :style="{ width: '100%' }" ></el-input>
        </el-form-item> 
        <el-form-item>
          <el-input v-model="searchInfo.desc" placeholder="文章描述" clearable :style="{ width: '100%' }" ></el-input>
        </el-form-item>           
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
    <!-- 查询表单结束 -->

    <!-- 列表展示开始 -->
    <el-table :data="tableData" @selection-change="handleSelectionChange" border ref="multipleTable" stripe style="width: 100%" tooltip-effect="dark">
      <el-table-column type="selection" width="55"></el-table-column>
      <el-table-column label="日期" prop="created_at" width="180"></el-table-column> 
      <el-table-column label="文章标题" prop="title" width="120"></el-table-column> 
      <el-table-column label="文章描述" prop="desc" width="120"></el-table-column> 
      <el-table-column label="作者" prop="author" width="120"></el-table-column> 
      <el-table-column label="文章内容" prop="content" width="120"></el-table-column> 
      <el-table-column label="文章标签" prop="tag" width="120"></el-table-column> 
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
    <el-pagination :current-page="page" :page-size="pageSize" :page-sizes="[10, 30, 50, 100]" :style="{float:'right',padding:'20px'}" :total="total" @current-change="handleCurrentChange" @size-change="handleSizeChange" layout="total, sizes, prev, pager, next, jumper"></el-pagination>
    <!-- 列表展示结束 -->

    <!-- 增改表单开始 -->
      <el-dialog :before-close="closeDialog" :visible.sync="dialogFormVisible" title="表单操作">
        <el-form ref="elForm" :model="formData" :rules="rules" size="mini" label-width="100px" label-position="left">
        <el-form-item label="文章标题" prop="title">
          <el-input v-model="formData.title" placeholder="请输入文章标题" clearable :style="{ width: '100%' }" ></el-input>
        </el-form-item>
        <el-form-item label="文章描述" prop="desc">
          <el-input v-model="formData.desc" placeholder="请输入文章描述" clearable :style="{ width: '100%' }" ></el-input>
        </el-form-item>
        <el-form-item label="选择作者" prop="author">
          <el-input v-model="formData.author" placeholder="请输入作者姓名" clearable :style="{ width: '100%' }"></el-input>
        </el-form-item>
        <el-form-item label="文章内容" prop="content">
          <el-input v-model="formData.content" type="textarea" placeholder="请输入文章内容" :autosize="{ minRows: 4, maxRows: 4 }" :style="{ width: '100%' }"></el-input>
        </el-form-item>
        <el-form-item label="文章标签" prop="tag">
          <el-input v-model="formData.tag" placeholder="请输入文章内容" clearable :style="{ width: '100%' }"></el-input>
        </el-form-item>
      </el-form>
      <div class="dialog-footer" slot="footer">
        <el-button @click="closeDialog">取 消</el-button>
        <el-button @click="enterDialog" type="primary">确 定</el-button>
      </div>
    </el-dialog>
    <!-- 增改表单结束 -->
  </div>
</template>

<script>
import {
    createBusArticle,
    updateBusArticle,
    findBusArticle,
    getBusArticleList,
    deleteBusArticle
} from "@/api/busArticle";  //  此处请自行替换地址
import { formatTimeToStr } from "@/utils/data";
import infoList from "@/components/mixins/infoList";
export default {
  name: "BusArticle",
  mixins: [infoList],
  data() {
    return {
      listApi: getBusArticleList,
      dialogFormVisible: false,
      visible: false,
      type: "",
      deleteVisible: false,
      multipleSelection: [],
      formData: {
        title:'',desc:'',author:'',content:'',tag:'',
      },
      rules: {
        title: [{ required: true, message: "请输入文章标题", trigger: "blur", }],
        desc: [{ required: true, message: "请输入文章描述", trigger: "blur", }],
        author: [{ required: true, message: "请输入作者", trigger: "blur", }],
        content: [{ required: true, message: "请输入文章内容", trigger: "blur", }],
        tag: [{ required: true, message: "请输入文章标签", trigger: "blur", }],
      },
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
            ids.push(item.id)
          })
        const res = await deleteBusArticle(JSON.stringify(ids))
        if (res.code == 200) {
          this.$message({
            type: 'success',
            message: '批量删除成功'
          })
          this.deleteVisible = false
          this.getTableData()
        }
      },
    async updateBusArticle(row) {
      const res = await findBusArticle(row.id);
      this.type = "update";
      if (res.code == 200) {
        this.formData = res.data.rebusArticle;
        this.dialogFormVisible = true;
      }
    },
    closeDialog() {
      this.dialogFormVisible = false;
      this.formData = {title:null,desc:null,author:null,content:null,tag:null};
    },
    async deleteBusArticle(row) {
      this.visible = false;
      const res = await deleteBusArticle(row.id);
      if (res.code == 200) {
        this.$message({
          type: "success",
          message: "删除成功"
        });
        this.getTableData();
      }
    },
    async enterDialog() {
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
          message:"操作成功"
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
    await this.getTableData();
  }
};
</script>

<style>
</style>