<template>
    <b-card no-body>
        <b-card-header class="border-0">
            <h3 class="mb-0">Light table</h3>
        </b-card-header>

        <el-table class="table-responsive table"
                  header-row-class-name="thead-light"
                  :data="projects">
            <el-table-column label="Project"
                             min-width="310px"
                             prop="name">
                <template v-slot="{row}">
                    <b-media no-body class="align-items-center">
                        <b-media-body>
                            <span class="font-weight-600 name mb-0 text-sm">Food name</span>
                        </b-media-body>
                    </b-media>
                </template>
            </el-table-column>

            <el-table-column label="Time"
                             prop="completion"
                             min-width="140px">
            </el-table-column>

            <el-table-column label="Price"
                             prop="budget"
                             min-width="140px">
            </el-table-column>
            <el-table-column label="Calories"
                             prop="completion"
                             min-width="140px">
            </el-table-column>
        </el-table>

        <b-card-footer class="py-4 d-flex justify-content-end">
            <base-pagination v-model="currentPage" :per-page="10" :total="50"></base-pagination>
        </b-card-footer>
    </b-card>
</template>
<script>
import projects from './projects'
import { Table, TableColumn} from 'element-ui'

export default {
    components: {
        [Table.name]: Table,
        [TableColumn.name]: TableColumn
    },
    data() {
        return {
            projects,
            currentPage: 1
        };
    },
    mounted() {
    }
}
</script>
