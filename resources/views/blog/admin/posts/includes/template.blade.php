<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">                
                <div class="card">
                    <div class="card-header">
                        Тестовый заголовок Пользователей
                    </div>
                    <form @submit.prevent="updateUser">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="maindata" role="tabpanel">
                                    <div class="form-group">
                                        <label for="title">Заголовок</label>
                                        <input name="title" value=""
                                            id="title"
                                            type="text"
                                            class="form-control"
                                            minlength="3"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="slug">Идентификатор</label>
                                        <input name="title" value=""
                                            id="slug"
                                            type="text"
                                            class="form-control">                                                                     
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Заголовок</label>
                                        <select name="parent_id"
                                            id="parent_id"                                  
                                            class="form-control"
                                            placeholder="Выберите категорию"
                                            required>
                                
                                            <option value="">
                                        
                                            </option>
                                
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Описание</label>
                                        <textarea name="description"
                                            id="description"
                                            class="form-control"
                                            rows="3">                                
                                        </textarea>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </form>    
                </div>
            </div>
        </div>           
    </div>