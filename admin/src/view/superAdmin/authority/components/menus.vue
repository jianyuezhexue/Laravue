<template>
  <div>
    <div class="clearflex">
      <el-button @click="relation" class="fl-right" size="small" type="primary"
        >确 定</el-button
      >
    </div>
    <el-tree
      :data="menuTreeData"
      :default-checked-keys="menuTreeIds"
      :props="menuDefaultProps"
      @check="nodeChange"
      default-expand-all
      highlight-current
      node-key="id"
      ref="menuTree"
      show-checkbox
    ></el-tree>
  </div>
</template>
<script>
import { getBaseMenuTree } from "@/api/menu";
import { addMenuAuthority } from "@/api/authority";

export default {
  name: "Menus",
  props: {
    row: {
      default: function () {
        return {};
      },
      type: Object,
    },
  },
  data() {
    return {
      menuTreeData: [],
      menuTreeIds: [],
      needConfirm: false,
      menuDefaultProps: {
        children: "children",
        label: function (data) {
          return data.meta.title;
        },
      },
    };
  },
  methods: {
    nodeChange() {
      this.needConfirm = true;
    },
    // 暴露给外层使用的切换拦截统一方法
    enterAndNext() {
      this.relation();
    },
    // 关联树 确认方法
    async relation() {
      const checkArr = this.$refs.menuTree.getCheckedNodes(false, false);
      let ids = [];
      checkArr.map((item) => {
        ids.push(item.id);
      });
      this.row.menu_ids = ids;
      const res = await addMenuAuthority(this.row.authority_id, this.row);
      if (res.code == 200) {
        this.$message({
          type: "success",
          message: "菜单设置成功!",
        });
      }
    },
  },
  async created() {
    // 获取所有菜单树
    const res = await getBaseMenuTree();
    this.menuTreeData = res.data.menus;
    this.menuTreeIds = this.row.menu_ids;
  },
};
</script>
<style lang="scss">
</style>