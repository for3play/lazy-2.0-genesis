Data Controller Demonstration - Editing Records
---

The below demonstration shows the querying and display of record for the table "tbl_books" where "book_id" = $_GET['id'].

* `$obj->getRecord(&lt;sql statement>) - retrieve a single record based on the SQL statement

PHP
<pre>
	{codePHP}
</pre>


HTML
<pre>
	&lt;form  method="POST" action="&#123SITEURL}data-controller/demonstration/update">
		&lt;div id="form">
			&lt;div>
				&lt;p>Book Title:&lt;/p>
				&lt;p>&lt;input type="text" name="title" value="&#123book_title}" class="&#123error-title}" style="width:190px;">*&lt;/p>
				&lt;p>&#123errorMsg-title}&lt;/p>
			&lt;/div>
			&lt;div>
				&lt;p>Book Author:&lt;/p>
				&lt;p>&lt;input type="text" name="author" value="&#123book_author}" class="&#123error-author}" style="width:190px;">*&lt;/p>
				&lt;p>&#123errorMsg-author}&lt;/p>
			&lt;/div>
			&lt;div>
				&lt;p>Date Published:&lt;/p>
				&lt;p>&lt;input type="text" name="date_published" value="&#123book_date_published}" class="&#123error-date_published}">&lt;/p>
				&lt;p>&lt;/p>
			&lt;/div>
			&lt;div>
				&lt;p># of pages:&lt;/p>
				&lt;p>&lt;input type="text" name="pages" value="&#123book_pages}" class="&#123error-pages}" style="width:50px;">&lt;/p>
				&lt;p>&#123errorMsg-pages}&lt;/p>
			&lt;/div>
			&lt;div>
				&lt;p>Author Email:&lt;/p>
				&lt;p>&lt;input type="text" name="author_email" value="&#123book_author_email}" class="&#123error-author_email}" style="width:190px;">&lt;/p>
				&lt;p>&#123errorMsg-author_email}&lt;/p>
			&lt;/div>
			&lt;div>
				&lt;p>Genre:&lt;/p>
				&lt;p>&lt;select name="fk_gen_id" class="&#123error-fk_gen_id}" style="width:190px;">
						&lt;option value=""> Select Genre &lt;/option>
						&lt;!-- BEGIN genres -->
							&lt;option value="&#123gen_id}" &#123gen_selected}>&#123gen_name}&lt;/option>
						&lt;!-- END genres -->
					&lt;/select>*
				&lt;/p>
				&lt;p>&#123errorMsg-fk_gen_id}&lt;/p>
			&lt;/div>
			&lt;input type="hidden" name="id" value="&#123book_id}">
			&lt;input type="hidden" name="action" value="UPDATE">
		&lt;/div>
		&lt;input type="submit">
	&lt;/form>
</pre>
