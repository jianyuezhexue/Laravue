<template>
  <div>
    <!-- 查询表单开始 -->
    <div class="search-term">
      <el-form :inline="true" :model="searchInfo" class="demo-form-inline">
        <el-form-item><el-input v-model="searchInfo.shortname" placeholder="简称" clearable :style="{ width: '100%' }" ></el-input></el-form-item>
        <!-- <el-form-item><el-input v-model="searchInfo.name" placeholder="名称" clearable :style="{ width: '100%' }" ></el-input></el-form-item> -->
        <!-- <el-form-item><el-input v-model="searchInfo.merger_name" placeholder="全称" clearable :style="{ width: '100%' }" ></el-input></el-form-item> -->
        <el-form-item><el-input v-model="searchInfo.pinyin" placeholder="拼音" clearable :style="{ width: '100%' }" ></el-input></el-form-item>
        <el-form-item><el-input v-model="searchInfo.first" placeholder="首字母" clearable :style="{ width: '100%' }" ></el-input></el-form-item>
           
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
      <!-- <el-table-column label="父id" prop="parent_id" width="50"></el-table-column> -->
      <el-table-column label="简称" prop="shortname" width="80"></el-table-column>
      <el-table-column label="名称" prop="name" width="120"></el-table-column>
      <!-- <el-table-column label="全称" prop="merger_name" width="180"></el-table-column> -->
      <!-- <el-table-column label="层级 0 1 2 省市区县" prop="level" width="120"></el-table-column> -->
      <el-table-column label="拼音" prop="pinyin" width="120"></el-table-column>
      <el-table-column label="长途区号" prop="code" width="100"></el-table-column>
      <el-table-column label="邮编" prop="zip_code" width="120"></el-table-column>
      <el-table-column label="首字母" prop="first" width="80"></el-table-column>
      <el-table-column label="经度" prop="lng" width="120"></el-table-column>
      <el-table-column label="纬度" prop="lat" width="120"></el-table-column>

      <el-table-column label="按钮组">
        <template slot-scope="scope">
          <el-button @click="updateBaseArea(scope.row)" size="small" type="primary">变更</el-button>
          <el-popover placement="top" width="160" v-model="scope.row.visible">
            <p>确定要删除吗？</p>
            <div style="text-align: right; margin: 0">
              <el-button size="mini" type="text" @click="scope.row.visible = false">取消</el-button>
              <el-button type="primary" size="mini" @click="deleteBaseArea(scope.row)">确定</el-button>
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
        <el-form-item label="父id" prop="title"><el-input v-model="formData.parent_id" placeholder="请输入父id" clearable :style="{ width: '100%' }" ></el-input></el-form-item>
        <el-form-item label="简称" prop="title"><el-input v-model="formData.shortname" placeholder="请输入简称" clearable :style="{ width: '100%' }" ></el-input></el-form-item>
        <el-form-item label="名称" prop="title"><el-input v-model="formData.name" placeholder="请输入名称" clearable :style="{ width: '100%' }" ></el-input></el-form-item>
        <el-form-item label="全称" prop="title"><el-input v-model="formData.merger_name" placeholder="请输入全称" clearable :style="{ width: '100%' }" ></el-input></el-form-item>
        <el-form-item label="层级 0 1 2 省市区县" prop="title"><el-input v-model="formData.level" placeholder="请输入层级 0 1 2 省市区县" clearable :style="{ width: '100%' }" ></el-input></el-form-item>
        <el-form-item label="拼音" prop="title"><el-input v-model="formData.pinyin" placeholder="请输入拼音" clearable :style="{ width: '100%' }" ></el-input></el-form-item>
        <el-form-item label="长途区号" prop="title"><el-input v-model="formData.code" placeholder="请输入长途区号" clearable :style="{ width: '100%' }" ></el-input></el-form-item>
        <el-form-item label="邮编" prop="title"><el-input v-model="formData.zip_code" placeholder="请输入邮编" clearable :style="{ width: '100%' }" ></el-input></el-form-item>
        <el-form-item label="首字母" prop="title"><el-input v-model="formData.first" placeholder="请输入首字母" clearable :style="{ width: '100%' }" ></el-input></el-form-item>
        <el-form-item label="经度" prop="title"><el-input v-model="formData.lng" placeholder="请输入经度" clearable :style="{ width: '100%' }" ></el-input></el-form-item>
        <el-form-item label="纬度" prop="title"><el-input v-model="formData.lat" placeholder="请输入纬度" clearable :style="{ width: '100%' }" ></el-input></el-form-item>

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
    createBaseArea,
    updateBaseArea,
    findBaseArea,
    getBaseAreaList,
    deleteBaseArea
} from "@/api/baseArea";  //  此处请自行替换地址
import { formatTimeToStr } from "@/utils/data";
import infoList from "@/components/mixins/infoList";
export default {
  name: "BaseArea",
  mixins: [infoList],
  data() {
    return {
      listApi: getBaseAreaList,
      dialogFormVisible: false,
      visible: false,
      type: "",
      deleteVisible: false,
      multipleSelection: [],
      formData: {parent_id:null,Shortname:null,Name:null,Merger_name:null,level:null,Pinyin:null,code:null,zip_code:null,First:null,lng:null,lat:null,},
      rules: {parent_id: [{ required: true, message: "请输入父id", trigger: "blur",}],
        shortname: [{ required: true, message: "请输入简称", trigger: "blur",}],
        name: [{ required: true, message: "请输入名称", trigger: "blur",}],
        merger_name: [{ required: true, message: "请输入全称", trigger: "blur",}],
        level: [{ required: true, message: "请输入层级 0 1 2 省市区县", trigger: "blur",}],
        pinyin: [{ required: true, message: "请输入拼音", trigger: "blur",}],
        code: [{ required: true, message: "请输入长途区号", trigger: "blur",}],
        zip_code: [{ required: true, message: "请输入邮编", trigger: "blur",}],
        first: [{ required: true, message: "请输入首字母", trigger: "blur",}],
        lng: [{ required: true, message: "请输入经度", trigger: "blur",}],
        lat: [{ required: true, message: "请输入纬度", trigger: "blur",}],
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
        const res = await deleteBaseArea(JSON.stringify(ids))
        if (res.code == 200) {
          this.$message({
            type: 'success',
            message: '批量删除成功'
          })
          this.deleteVisible = false
          this.getTableData()
        }
      },
    async updateBaseArea(row) {
      const res = await findBaseArea(row.id);
      this.type = "update";
      if (res.code == 200) {
        this.formData = res.data;
        this.dialogFormVisible = true;
      }
    },
    closeDialog() {
      this.dialogFormVisible = false;
      this.formData = {parent_id:null,Shortname:null,Name:null,Merger_name:null,level:null,Pinyin:null,code:null,zip_code:null,First:null,lng:null,lat:null,};
    },
    async deleteBaseArea(row) {
      this.visible = false;
      const res = await deleteBaseArea(row.id);
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
          res = await createBaseArea(this.formData);
          break;
        case "update":
          res = await updateBaseArea(this.formData.id, this.formData);
          break;
        default:
          res = await createBaseArea(this.formData);
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