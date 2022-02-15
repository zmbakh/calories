<template>
    <div>
        <div class="header pb-8 pt-5 pt-lg-6 d-flex align-items-center profile-header">
            <b-container fluid>
                <!-- Mask -->
                <span class="mask bg-gradient-success opacity-8"></span>
                <!-- Header container -->
                <b-container fluid class="d-flex align-items-center">

                </b-container>
            </b-container>
        </div>

        <b-container fluid class="mt--6">
            <b-row>
                <b-col xl="4" class="mb-5">
                    <card>
                        <b-row align-v="center" slot="header">
                            <b-col cols="8">
                                <h3 class="mb-0">Add Food Entry</h3>
                            </b-col>
                        </b-row>

                        <validation-observer v-slot="{handleSubmit}" ref="formValidator">
                            <b-form role="form" @submit.prevent="handleSubmit(onSubmit)">
                                <div class="pl-lg-4">
                                    <b-row>
                                        <b-col lg="12">
                                            <base-input label="User" :rules="{required: true}" name="User">
                                                <select class="form-control"
                                                        v-model="model.userId"
                                                >
                                                    <option :value="null" disabled>Select a user</option>
                                                    <option v-for="user in users" v-bind:value="user.id">
                                                        {{ user.name }} {{ user.last_name }}
                                                    </option>
                                                </select>
                                            </base-input>
                                        </b-col>
                                        <b-col lg="12">
                                            <base-input
                                                type="text"
                                                label="Food name"
                                                placeholder="Food name"
                                                name="Food name"
                                                v-model="model.name"
                                                :rules="{required: true}"
                                            >
                                            </base-input>
                                        </b-col>
                                        <b-col lg="12">
                                            <base-input
                                                type="number"
                                                label="Calories"
                                                placeholder="Calories"
                                                name="Calories"
                                                v-model="model.calories"
                                                :rules="{required: true}"
                                            >
                                            </base-input>
                                        </b-col>
                                        <b-col lg="12">
                                            <base-input
                                                type="number"
                                                label="Price"
                                                name="Price"
                                                placeholder="Price"
                                                v-model="model.price"
                                            >
                                            </base-input>
                                        </b-col>
                                        <b-col lg="12">
                                            <base-input
                                                type="datetime-local"
                                                name="Datetime"
                                                v-model="model.dateTime"
                                                label="Datetime"
                                                :rules="{required: true}"
                                            />
                                        </b-col>

                                        <b-col lg="12">
                                            <div class="text-center">
                                                <base-button type="primary" native-type="submit" block class="my-4">
                                                    Submit
                                                </base-button>
                                            </div>
                                        </b-col>
                                    </b-row>
                                </div>

                            </b-form>
                        </validation-observer>
                    </card>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>
<script>
import {format} from "date-fns";
import userRepository from "@/repositories/admin/user/userRepository";
import foodEntryRepository from "@/repositories/admin/food/foodEntryRepository";

export default {
    data() {
        return {
            users: [],
            model: {
                userId: null,
                name: null,
                dateTime: null,
                calories: null,
                price: null,
            }
        };
    },
    mounted() {
        this.getUsers();
        this.setDatetime();
    },
    methods: {
        setDatetime() {
            this.model.dateTime = format(new Date(), 'YYYY-MM-DDTHH:mm');
        },
        onSubmit() {
            foodEntryRepository.create(this.model).then(() => {
                this.$notify({
                    group: 'notification',
                    title: 'Food entry was successfully added',
                    position: 'top center',
                });
                this.$router.push({name: 'admin-food-entries'});
            });
        },
        getUsers() {
            userRepository.index().then(response => {
                this.users = response.data;
            });
        }
    }
};
</script>
<style>
</style>
