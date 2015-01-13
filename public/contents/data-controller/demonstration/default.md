Data Controller Demonstration
---

The data controller object takes raw SQL for queries and returns an associative array with Dataset information.

An optional page array can be passed to the data controller object to set the current page and number of records per page.
* `page_array` - associative array which stores paging information
	* `[currPage]` - sets page of records, assigned from $_GET or $_POST variables
	* `[recPerPage]` - sets records per page


Return Object
* `$obj['info']` - contains paging and recordset information
	* `$obj['info']['recordCount']` - contains the records returned for this page, or the total records is no paging array is passed
	* `$obj['info']['totalRecords']` - contains the total records for the query, returns empty is no paging array is passed
	* `$obj['info']['currentPage']` - contains the current page number, returns empty is no paging array is passed
	* `$obj['info']['totalPages']` - contains the total number of pages, returns empty is no paging array is passed
* `$obj['data']` - contains the recordset as an associative array


The below demonstration shows the querying and display of records for the table "tbl_books".

The `$qry` object is instantiated as `Lazy\DataController` in the global script variable under `contents/public/data-controller/demonstration/global.php` and is used globally under this section.

PHP
<pre>
	{codePHP}
</pre>

HTML
<pre>
	&lt;div id="table">
		&lt;table>
			&lt;tr class="header">
				&lt;td class="title">Book Title&lt;/td>
				&lt;td class="author">Author&lt;/td>
				&lt;td class="category">Genre&lt;/td>
				&lt;td> &lt;/td>
			&lt;/tr>
			&lt;!-- BEGIN books -->
				&lt;tr>
					&lt;td>&#123;book_title}&lt;/td>
					&lt;td>&#123;book_author}&lt;/td>
					&lt;td>&#123;gen_name}&lt;/td>
					&lt;td>&lt;a href="edit?id=&#123;book_id}">Edit&lt;/a>&lt;/td>
				&lt;/tr>
			&lt;!-- END books -->
			&lt;!-- BEGIN empty -->
				&lt;tr>&lt;td colspan="4" class="empty">No Records Found &#123;empty}&lt;/td>&lt;/tr>
			&lt;!-- END empty -->
			&lt;tr>
				&lt;td colspan="2" class="info">
					Showing &#123;recordCount} record(s). Total Records: &#123;totalRecords}. Page &#123;currentPage} of &#123;totalPages}
				&lt;/td>
				&lt;td colspan="2" class="paging">
					&lt;a name="paging">
					Page: &nbsp; &nbsp; &lt;!-- BEGIN paging -->&lt;a href="?page=&#123;page}#paging" class="&#123;page-active}">&#123;page}&lt;/a> &nbsp; &lt;!-- END paging -->
				&lt;/td>
			&lt;/tr>
		&lt;/table>
	&lt;/div>
</pre>
