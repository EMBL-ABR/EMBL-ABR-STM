
/*
Copyright 2015 Vasileios Lapatas

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

	http://www.apache.org/licenses/LICENSE-2.0

	Unless required by applicable law or agreed to in writing, software
	distributed under the License is distributed on an "AS IS" BASIS,
	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	See the License for the specific language governing permissions and
	limitations under the License.
*/

var Search = Class.create({
	init: function(q, only_files) {
		this.q           = q;
		this.only_files  = (typeof(only_files) == "undefined") ? false : only_files;
		this.url         = "api.php";
		this.items       = [];
		this.table_view  = "";
		this.google_view = "";
		this.response    = "";
		this.refresh     = false;
		this.ref_count   = 1;
		this.items_len   = 0;
	},

	search: function(q, only_files, refresh) {
		var prev_q      = this.q;

		this.q          = (typeof(q)          == "undefined") ? this.q : q;
		this.only_files = (typeof(only_files) == "undefined") ? this.only_files : only_files;
		this.refresh    = (typeof(refresh)    == "undefined") ? this.refresh : refresh;


		if(typeof(this.q) == "undefined") return false;

		if(prev_q != this.q) {
			this.hide_results();
		}

		var req = this.url + "?q=" + encodeURIComponent(this.q);

		self = this;

		$.ajax({
			url: req,
			success: function( data ) {
				if(data == "null") {
					self.refresh = false;
					return;
				}
				self.response = jQuery.parseJSON(data);
				self.items = jQuery.parseJSON(data).items;
				if(self.items) {
					self.items_len = self.items.length;
					for(var i = 0; i < self.items.length; i++) {
						if (self.items[i].files.length == 0 && self.only_files) {
							delete self.items[i];
							self.items_len = self.items_len - 1;
						}
					}
				}

				if(self.items_len === 0) {
					self.no_results();
				}
				else {
					self.show_results();
					self.sort_by($('#sort').val());
					if(self.refresh) {
						self.refresh   = false;
						setTimeout(function() {self.search(self.q, self.only_files);}, 5000);
					}
				}
			}
		});
	},

	no_results: function() {
		$('#num_results').html("0 results");
		$("#results").html("<div class=\"col-md-6 col-md-offset-3\"><div class=\"alert alert-danger\" role=\"alert\" style=\"clear: left; text-align: center;\">There were no results for that query. Please try a different search term.</div></div>");

	},

	show_results: function() {
		this.table_view  = this.get_table_view();
		this.google_view = this.get_google_view();

		if($('#view_default').hasClass('active')) {
			$('#results').html(s.table_view);
		} else if($('#view_google').hasClass('active')) {
			$('#results').html(s.google_view);
		}

		if(typeof(this.response.queries.nextPage) == "undefined" ||
			this.response.queries.nextPage[0].startIndex > 100) {
			$('#next').css('display', 'none');
		} else {
			$('#next').css('display', 'block');
		}

		if(typeof(this.response.queries.previousPage) == "undefined") {
			$('#prev').css('display', 'none');
		} else {
			$('#prev').css('display', 'block');
		}

		var results = this.response.searchInformation.totalResults > 100 ? "100+" : this.response.searchInformation.totalResults;
		$('#num_results').html(results + " results");
		if (self.items_len === 0) {
			$('#num_results').html("0 results");
		}
		$("#bar_filter").css('display', '');

		this.draw_pages(true);

	},

	hide_results: function() {
		$("#results").html("");
		$("#num_results").html("");
		$('#pages').html("");
		$('#next').css('display', 'none');
		$('#prev').css('display', 'none');
		$("#bar_filter").css('display', 'none');
	},

	get_table_view: function() {

		var table  = "<table class=\"table\"><thead>";
		table     += "<tr><th><h4>Site</h4></th><th><h4>Title</h4></th><th><h4>Description</h4></th><th style=\"max-width: 300px; overflow-wrap: break-word;\"><h4>Files</h4></th></tr></thead><tbody>";
		if (self.items_len === 0) {
			self.no_results();
			return;
		} else {
			for(var i = 0; i < this.items.length; i++) {
				if(typeof(this.items[i]) != "undefined") {
					table += "<tr><td>" + this.items[i].displayLink + "</td><td><a href=\"" + this.items[i].link + "\">" + this.items[i].title + "</a></td><td>" + this.items[i].htmlSnippet + "</td><td style=\"max-width: 300px; overflow-wrap: break-word;\">" + this._get_file_html(this.items[i].files) + "</td></tr>";
				}
			}
			table += "</tbody></table>";
		}
		return table;
	},

	get_google_view: function() {
		var content = "";
		if (self.items_len === 0) {
			self.no_results();
			return;
		} else {
			for(var i = 0; i < this.items.length; i++) {
				if(typeof(this.items[i]) != "undefined") {
					content += "<div class=\"google\"><a href=\"" + this.items[i].link + "\">" + this.items[i].title + "</a><br /><span class=\"glink\">" + this.items[i].displayLink + "</span><br /><span class=\"gdesc\">" + this.items[i].htmlSnippet + "</span>" + this._get_file_html(this.items[i].files) + "</div>";
					if(!this.items[i].files) {
						this.refresh = true;
					}
				}
			}
		}
		return content;
	},

	// HTML for file list
	_get_file_html: function(flist) {
		var html = "<ul>";
		for(var i = 0; i < flist.length; i++){
			html += "<li><a href=\"" + flist[i].flink + "\">" + flist[i].fname + "</a></li>";
		}
		html += "</ul>";
		return html;
	},

	sort_by: function(col) {
		if(col === "-"||this.items.length == 0) return;
		var sort_by = function(field, reverse, primer){
			var key = primer ?
			function(x) {return primer(x[field])} :
			function(x) {return x[field]};

			reverse = !reverse ? 1 : -1;

			return function (a, b) {
				return a = key(a), b = key(b), reverse * ((a > b) - (b > a));
			}
		}

		this.items = this.items.sort(sort_by(col, false, function(a){return a.toUpperCase()}));
		this.show_results();
	},

	go_next: function() {
		var page = Math.floor(this.response.queries.nextPage[0].startIndex / this.response.queries.nextPage[0].count);
		this.goto_page(page);
	},

	go_prev: function() {
		var page = Math.floor(this.response.queries.previousPage[0].startIndex / this.response.queries.previousPage[0].count);
		this.goto_page(page);
	},

	goto_page: function(page) {
		var startIndex = (page * this.response.queries.request[0].count) + 1;

		if(this.q.toLowerCase().search("&start=") > -1) {
			this.q = this.q.replace(/&start=\d+/i, "&start=" + startIndex);
		} else {
			this.q += "&start=" + startIndex;
		}

		this.search(this.q, this.only_files, false);

	},

	draw_pages: function(first_10) {

		first_10 = typeof(first_10) == undefined? false : first_10;

		var total     = this.response.searchInformation.totalResults;
		var count     = this.response.queries.request[0].count;
		var current   = Math.floor(this.response.queries.request[0].startIndex/count);
		var num_pages = Math.floor(total/count);
		var el        = $('#pages');

		el.html("");


		var show_first   = 5;
		var show_last    = 3;
		var show_middle  = 2;

		if(first_10) {
			num_pages  = Math.min(num_pages, 10);
			show_first = 10;
		}

		for (var i = 0; i < num_pages; i++) {
			if (i < show_first ||
				i > num_pages - show_last ||
				(current >= i - show_middle &&
				current <= i + show_middle)) {
				var n = i + 1;
				if(i != current) {
					var span = $('<span></span>')
									.addClass("page")
									.append(
										$('<a>' + n + '</a>')
											.attr({ href: "#", onclick: "s.goto_page(" + i + ");"})
									);
				} else {
					var span = $('<span>' + n + '</span>').addClass("page");
				}

				el.append(span);
			}
			if(
				(i == show_first && i < current - show_middle) ||
				(i == Math.max(current + show_middle, show_first) && i <= num_pages - show_last)
				) {
				el.append($('<span>...</span>').addClass("page"));
			}
		}
	}

});
