var define;
(function(a) {
	if (typeof define === "function") {
		if (define.amd) {
			define("wangEditor", ["jquery"], a)
		} else {
			if (define.cmd) {
				define(function(d, b, c) {
					return a
				})
			} else {
				a(window.jQuery)
			}
		}
	} else {
		a(window.jQuery)
	}
})(function(a) {
	var b = function(d) {
			var c = window.wangEditor;
			if (c) {
				d(c, a)
			}
		};
	(function(e, c) {
		if (e.wangEditor) {
			alert("一个页面不能重复引用 wangEditor.js 或 wangEditor.min.js ！！！");
			return
		}
		var d = function(g) {
				var f = c("#" + g);
				if (f.length !== 1) {
					return
				}
				var h = f[0].nodeName;
				if (h !== "TEXTAREA" && h !== "DIV") {
					return
				}
				this.valueNodeName = h.toLowerCase();
				this.$valueContainer = f;
				this.$prev = f.prev();
				this.$parent = f.parent();
				this.init()
			};
		d.fn = d.prototype;
		d.$body = c("body");
		d.$document = c(document);
		d.$window = c(e);
		d.userAgent = navigator.userAgent;
		d.getComputedStyle = e.getComputedStyle;
		d.w3cRange = typeof document.createRange === "function";
		d.hostname = location.hostname.toLowerCase();
		d.websiteHost = "wangeditor.github.io";
		d.isOnWebsite = d.hostname === d.websiteHost;
		d.docsite = "http://www.kancloud.cn/wangfupeng/wangeditor2/113961";
		e.wangEditor = d;
		d.plugin = function(f) {
			if (!d._plugins) {
				d._plugins = []
			}
			if (typeof f === "function") {
				d._plugins.push(f)
			}
		}
	})(window, a);
	b(function(d, c) {
		d.fn.init = function() {
			this.initDefaultConfig();
			this.addEditorContainer();
			this.addTxt();
			this.addMenuContainer();
			this.menus = {};
			this.commandHooks()
		}
	});
	b(function(d, c) {
		d.fn.ready = function(e) {
			if (!this.readyFns) {
				this.readyFns = []
			}
			this.readyFns.push(e)
		};
		d.fn.readyHeadler = function() {
			var e = this.readyFns;
			while (e.length) {
				e.shift().call(this)
			}
		};
		d.fn.updateValue = function() {
			var g = this;
			var f = g.$valueContainer;
			var e = g.txt.$txt;
			if (f === e) {
				return
			}
			var h = e.html();
			f.val(h)
		};
		d.fn.getInitValue = function() {
			var g = this;
			var e = g.$valueContainer;
			var f = "";
			var h = g.valueNodeName;
			if (h === "div") {
				f = e.html()
			} else {
				if (h === "textarea") {
					f = e.val()
				}
			}
			return f
		};
		d.fn.updateMenuStyle = function() {
			var e = this.menus;
			c.each(e, function(f, g) {
				g.updateSelected()
			})
		};
		d.fn.enableMenusExcept = function(e) {
			if (this._disabled) {
				return
			}
			e = e || [];
			if (typeof e === "string") {
				e = [e]
			}
			c.each(this.menus, function(f, g) {
				if (e.indexOf(f) >= 0) {
					return
				}
				g.disabled(false)
			})
		};
		d.fn.disableMenusExcept = function(e) {
			if (this._disabled) {
				return
			}
			e = e || [];
			if (typeof e === "string") {
				e = [e]
			}
			c.each(this.menus, function(f, g) {
				if (e.indexOf(f) >= 0) {
					return
				}
				g.disabled(true)
			})
		};
		d.fn.hideDropPanelAndModal = function() {
			var e = this.menus;
			c.each(e, function(f, h) {
				var g = h.dropPanel || h.dropList || h.modal;
				if (g && g.hide) {
					g.hide()
				}
			})
		}
	});
	b(function(d, c) {
		var f = !d.w3cRange;

		function e() {}
		d.fn.currentRange = function(g) {
			if (g) {
				this._rangeData = g
			} else {
				return this._rangeData
			}
		};
		d.fn.collapseRange = function(h, g) {
			g = g || "end";
			g = g === "start" ? true : false;
			h = h || this.currentRange();
			if (h) {
				h.collapse(g);
				this.currentRange(h)
			}
		};
		d.fn.getRangeText = f ? e : function(g) {
			g = g || this.currentRange();
			if (!g) {
				return
			}
			return g.toString()
		};
		d.fn.getRangeElem = f ? e : function(h) {
			h = h || this.currentRange();
			var g = h.commonAncestorContainer;
			if (g.nodeType === 1) {
				return g
			} else {
				return g.parentNode
			}
		};
		d.fn.isRangeEmpty = f ? e : function(g) {
			g = g || this.currentRange();
			if (g && g.startContainer) {
				if (g.startContainer === g.endContainer) {
					if (g.startOffset === g.endOffset) {
						return true
					}
				}
			}
			return false
		};
		d.fn.saveSelection = f ? e : function(h) {
			var j = this,
				g, i, k = j.txt.$txt.get(0);
			if (h) {
				g = h.commonAncestorContainer
			} else {
				i = document.getSelection();
				if (i.getRangeAt && i.rangeCount) {
					h = document.getSelection().getRangeAt(0);
					g = h.commonAncestorContainer
				}
			}
			if (g && (c.contains(k, g) || k === g)) {
				j.currentRange(h)
			}
		};
		d.fn.restoreSelection = f ? e : function(g) {
			var h;
			g = g || this.currentRange();
			if (!g) {
				return
			}
			h = document.getSelection();
			h.removeAllRanges();
			h.addRange(g)
		};
		d.fn.restoreSelectionByElem = f ? e : function(g, h) {
			if (!g) {
				return
			}
			h = h || "end";
			this.setRangeByElem(g);
			if (h === "start") {
				this.collapseRange(this.currentRange(), "start")
			}
			if (h === "end") {
				this.collapseRange(this.currentRange(), "end")
			}
			this.restoreSelection()
		};
		d.fn.initSelection = f ? e : function() {
			var i = this;
			if (i.currentRange()) {
				return
			}
			var j;
			var h = i.txt.$txt;
			var g = h.children().first();
			if (g.length) {
				i.restoreSelectionByElem(g.get(0))
			}
		};
		d.fn.setRangeByElem = f ? e : function(h) {
			var g = this;
			var l = g.txt.$txt.get(0);
			if (!h || !c.contains(l, h)) {
				return
			}
			var i = h.firstChild;
			while (i) {
				if (i.nodeType === 3) {
					break
				}
				i = i.firstChild
			}
			var j = h.lastChild;
			while (j) {
				if (j.nodeType === 3) {
					break
				}
				j = j.lastChild
			}
			var k = document.createRange();
			if (i && j) {
				k.setStart(i, 0);
				k.setEnd(j, j.textContent.length)
			} else {
				k.setStart(h, 0);
				k.setEnd(h, 0)
			}
			g.saveSelection(k)
		}
	});
	b(function(d, c) {
		d.fn.commandHooks = function() {
			var f = this;
			var e = {};
			e.insertHtml = function(h) {
				var g = c(h);
				var i = f.getRangeElem();
				var j;
				j = f.getLegalTags(i);
				if (!j) {
					return
				}
				c(j).after(g)
			};
			f.commandHooks = e
		}
	});
	b(function(d, c) {
		d.fn.command = function(j, h, i, f) {
			var k = this;
			var l;

			function g() {
				if (!h) {
					return
				}
				if (k.queryCommandSupported(h)) {
					document.execCommand(h, false, i)
				} else {
					l = k.commandHooks;
					if (h in l) {
						l[h](i)
					}
				}
			}
			this.customCommand(j, g, f)
		};
		d.fn.commandForElem = function(k, j, h, i, f) {
			var m;
			var g;
			if (typeof k === "string") {
				m = k
			} else {
				m = k.selector;
				g = k.check
			}
			var l = this.getRangeElem();
			l = this.getSelfOrParentByName(l, m, g);
			if (l) {
				this.setRangeByElem(l)
			}
			this.command(j, h, i, f)
		};
		d.fn.customCommand = function(h, g, f) {
			var i = this;
			var k = i.currentRange();
			if (!k) {
				h && h.preventDefault();
				return
			}
			i.undoRecord();
			this.restoreSelection(k);
			g.call(i);
			this.saveSelection();
			this.restoreSelection();
			if (f && typeof f === "function") {
				f.call(i)
			}
			i.txt.insertEmptyP();
			i.updateValue();
			i.updateMenuStyle();

			function j() {
				i.hideDropPanelAndModal()
			}
			setTimeout(j, 200);
			if (h) {
				h.preventDefault()
			}
		};
		d.fn.queryCommandValue = function(e) {
			var g = "";
			try {
				g = document.queryCommandValue(e)
			} catch (f) {}
			return g
		};
		d.fn.queryCommandState = function(e) {
			var g = false;
			try {
				g = document.queryCommandState(e)
			} catch (f) {}
			return g
		};
		d.fn.queryCommandSupported = function(e) {
			var g = false;
			try {
				g = document.queryCommandSupported(e)
			} catch (f) {}
			return g
		}
	});
	b(function(e, c) {
		var f;

		function d(j) {
			var h = this;
			var g = c(j);
			var i = false;
			g.each(function() {
				if (this === h) {
					i = true;
					return false
				}
			});
			return i
		}
		e.fn.getLegalTags = function(g) {
			var h = this.config.legalTags;
			if (!h) {
				e.error("配置项中缺少 legalTags 的配置");
				return
			}
			return this.getSelfOrParentByName(g, h)
		};
		e.fn.getSelfOrParentByName = function(h, i, g) {
			if (!h || !i) {
				return
			}
			if (!f) {
				f = h.webkitMatchesSelector || h.mozMatchesSelector || h.oMatchesSelector || h.matchesSelector
			}
			if (!f) {
				f = d
			}
			var j = this.txt.$txt.get(0);
			while (h && j !== h && c.contains(j, h)) {
				if (f.call(h, i)) {
					if (!g) {
						return h
					}
					if (g(h)) {
						return h
					}
				}
				h = h.parentNode
			}
			return
		}
	});
	b(function(e, c) {
		var g = [];
		var h = [];
		var f = 20;

		function d(j, i) {
			var k = i.val;
			if (k == null) {
				return
			}
			j.txt.$txt.html(k);
			j.updateValue()
		}
		e.fn.undoRecord = function() {
			var k = this;
			var i = k.txt.$txt;
			var l = i.html();
			var j = h.length ? h[0] : "";
			if (l === j) {
				return
			}
			if (g.length) {
				g = []
			}
			h.unshift({
				range: k.currentRange(),
				val: i.html()
			});
			if (h.length > f) {
				h.pop()
			}
		};
		e.fn.undo = function() {
			if (!h.length) {
				return
			}
			var i = h.shift();
			g.unshift(i);
			d(this, i)
		};
		e.fn.redo = function() {
			if (!g.length) {
				return
			}
			var i = g.shift();
			h.unshift(i);
			d(this, i)
		}
	});
	b(function(d, c) {
		d.fn.create = function() {
			var f = this;
			f.addMenus();
			f.renderMenus();
			f.renderMenuContainer();
			f.renderTxt();
			f.renderEditorContainer();
			f.eventMenus();
			f.eventMenuContainer();
			f.eventTxt();
			f.readyHeadler();
			f.initSelection();
			var e = d._plugins;
			if (e && e.length) {
				c.each(e, function(g, h) {
					h.call(f)
				})
			}
			f.$txt = f.txt.$txt
		};
		d.fn.disable = function() {
			this.txt.$txt.removeAttr("contenteditable");
			this.disableMenusExcept();
			this._disabled = true
		};
		d.fn.enable = function() {
			this._disabled = false;
			this.txt.$txt.attr("contenteditable", "true");
			this.enableMenusExcept()
		};
		d.fn.destroy = function() {
			var g = this;
			var f = g.$valueContainer;
			var e = g.$editorContainer;
			var h = g.valueNodeName;
			if (h === "div") {
				f.removeAttr("contenteditable");
				e.after(f);
				e.hide()
			} else {
				f.show();
				e.hide()
			}
		};
		d.fn.undestroy = function() {
			var h = this;
			var g = h.$valueContainer;
			var e = h.$editorContainer;
			var f = h.menuContainer.$menuContainer;
			var i = h.valueNodeName;
			if (i === "div") {
				g.attr("contenteditable", "true");
				f.after(g);
				e.show()
			} else {
				g.hide();
				e.show()
			}
		};
		d.fn.clear = function() {
			var f = this;
			var e = f.txt.$txt;
			e.html("<p><br></p>");
			f.restoreSelectionByElem(e.find("p").get(0))
		}
	});
	b(function(d, c) {
		var e = function(f) {
				this.editor = f;
				this.init()
			};
		e.fn = e.prototype;
		d.MenuContainer = e
	});
	b(function(d, c) {
		var e = d.MenuContainer;
		e.fn.init = function() {
			var g = this;
			var f = c('<div class="wangEditor-menu-container clearfix"></div>');
			g.$menuContainer = f;
			g.changeShadow()
		};
		e.fn.changeShadow = function() {
			var f = this.$menuContainer;
			var h = this.editor;
			var g = h.txt.$txt;
			g.on("scroll", function() {
				if (g.scrollTop() > 10) {
					f.addClass("wangEditor-menu-shadow")
				} else {
					f.removeClass("wangEditor-menu-shadow")
				}
			})
		}
	});
	b(function(d, c) {
		var e = d.MenuContainer;
		e.fn.render = function() {
			var g = this.$menuContainer;
			var f = this.editor.$editorContainer;
			f.append(g)
		};
		e.fn.height = function() {
			var f = this.$menuContainer;
			return f.height()
		};
		e.fn.appendMenu = function(f, g) {
			this._addGroup(f);
			return this._addOneMenu(g)
		};
		e.fn._addGroup = function(h) {
			var f = this.$menuContainer;
			var g;
			if (!this.$currentGroup || this.currentGroupIdx !== h) {
				g = c('<div class="menu-group clearfix"></div>');
				f.append(g);
				this.$currentGroup = g;
				this.currentGroupIdx = h
			}
		};
		e.fn._addOneMenu = function(j) {
			var h = j.$domNormal;
			var i = j.$domSelected;
			var g = this.$currentGroup;
			var f = c('<div class="menu-item clearfix"></div>');
			i.hide();
			f.append(h).append(i);
			g.append(f);
			return f
		}
	});
	b(function(d, c) {
		var e = function(f) {
				this.editor = f.editor;
				this.id = f.id;
				this.title = f.title;
				this.$domNormal = f.$domNormal;
				this.$domSelected = f.$domSelected || f.$domNormal;
				this.commandName = f.commandName;
				this.commandValue = f.commandValue;
				this.commandNameSelected = f.commandNameSelected || f.commandName;
				this.commandValueSelected = f.commandValueSelected || f.commandValue
			};
		e.fn = e.prototype;
		d.Menu = e
	});
	b(function(d, c) {
		var e = d.Menu;
		e.fn.initUI = function() {
			var f = this.editor;
			var i = f.UI.menus;
			var g = this.id;
			var h = i[g];
			if (this.$domNormal && this.$domSelected) {
				return
			}
			if (h == null) {
				d.warn('editor.UI配置中，没有菜单 "' + g + '" 的UI配置，只能取默认值');
				h = i["default"]
			}
			this.$domNormal = c(h.normal);
			if (/^\./.test(h.selected)) {
				this.$domSelected = this.$domNormal.clone().addClass(h.selected.slice(1))
			} else {
				this.$domSelected = c(h.selected)
			}
		}
	});
	b(function(d, c) {
		var e = d.Menu;
		e.fn.render = function(h) {
			this.initUI();
			var g = this.editor;
			var i = g.menuContainer;
			var f = i.appendMenu(h, this);
			var j = this.onRender;
			this._renderTip(f);
			if (j && typeof j === "function") {
				j.call(this)
			}
		};
		e.fn._renderTip = function(f) {
			var k = this;
			var i = k.editor;
			var n = k.title;
			var h = c('<div class="menu-tip"></div>');
			var g;
			if (!k.tipWidth) {
				g = c('<p style="opacity:0; filter:Alpha(opacity=0); position:absolute;top:-10000px;">' + n + "</p>");
				d.$body.append(g);
				i.ready(function() {
					var q = this;
					var r = g.outerWidth() + 5;
					var p = h.outerWidth();
					var o = parseFloat(h.css("margin-left"), 10);
					g.remove();
					g = null;
					h.css({
						width: r,
						"margin-left": o + (p - r) / 2
					});
					k.tipWidth = r
				})
			}
			h.append(n);
			f.append(h);

			function l() {
				h.show()
			}
			function j() {
				h.hide()
			}
			var m;
			f.find("a").on("mouseenter", function(o) {
				if (!k.active() && !k.disabled()) {
					m = setTimeout(l, 200)
				}
			}).on("mouseleave", function(o) {
				m && clearTimeout(m);
				j()
			}).on("click", j)
		};
		e.fn.bindEvent = function() {
			var j = this;
			var f = j.$domNormal;
			var g = j.$domSelected;
			var h = j.clickEvent;
			if (!h) {
				h = function(n) {
					var m = j.dropPanel || j.dropList || j.modal;
					if (m && m.show) {
						if (m.isShowing) {
							m.hide()
						} else {
							m.show()
						}
						return
					}
					var o = j.editor;
					var k;
					var l;
					var p = j.selected;
					if (p) {
						k = j.commandNameSelected;
						l = j.commandValueSelected
					} else {
						k = j.commandName;
						l = j.commandValue
					}
					if (k) {
						o.command(n, k, l)
					} else {
						d.warn('菜单 "' + j.id + '" 未定义click事件');
						n.preventDefault()
					}
				}
			}
			var i = j.clickEventSelected || h;
			f.click(function(k) {
				if (!j.disabled()) {
					h.call(j, k);
					j.updateSelected()
				}
				k.preventDefault()
			});
			g.click(function(k) {
				if (!j.disabled()) {
					i.call(j, k);
					j.updateSelected()
				}
				k.preventDefault()
			})
		};
		e.fn.updateSelected = function() {
			var h = this;
			var f = h.editor;
			var i = h.updateSelectedEvent;
			if (!i) {
				i = function() {
					var m = this;
					var l = m.editor;
					var j = m.commandName;
					var k = m.commandValue;
					if (k) {
						if (l.queryCommandValue(j).toLowerCase() === k.toLowerCase()) {
							return true
						}
					} else {
						if (l.queryCommandState(j)) {
							return true
						}
					}
					return false
				}
			}
			var g = i.call(h);
			g = !! g;
			h.changeSelectedState(g)
		};
		e.fn.changeSelectedState = function(h) {
			var g = this;
			var f = g.selected;
			if (h != null && typeof h === "boolean") {
				if (f === h) {
					return
				}
				g.selected = h;
				if (h) {
					g.$domNormal.hide();
					g.$domSelected.show()
				} else {
					g.$domNormal.show();
					g.$domSelected.hide()
				}
			}
		};
		e.fn.active = function(f) {
			if (f == null) {
				return this._activeState
			}
			this._activeState = f
		};
		e.fn.activeStyle = function(h) {
			var i = this.selected;
			var f = this.$domNormal;
			var g = this.$domSelected;
			if (h) {
				f.addClass("active");
				g.addClass("active")
			} else {
				f.removeClass("active");
				g.removeClass("active")
			}
			this.active(h)
		};
		e.fn.disabled = function(h) {
			if (h == null) {
				return !!this._disabled
			}
			if (this._disabled === h) {
				return
			}
			var f = this.$domNormal;
			var g = this.$domSelected;
			if (h) {
				f.addClass("disable");
				g.addClass("disable")
			} else {
				f.removeClass("disable");
				g.removeClass("disable")
			}
			this._disabled = h
		}
	});
	b(function(e, c) {
		var d = function(f, g, h) {
				this.editor = f;
				this.menu = g;
				this.$content = h.$content;
				this.width = h.width || 200;
				this.height = h.height;
				this.onRender = h.onRender;
				this.init()
			};
		d.fn = d.prototype;
		e.DropPanel = d
	});
	b(function(e, c) {
		var d = e.DropPanel;
		d.fn.init = function() {
			var f = this;
			f.initDOM();
			f.initHideEvent()
		};
		d.fn.initDOM = function() {
			var j = this;
			var f = j.$content;
			var k = j.width;
			var i = j.height;
			var g = c('<div class="wangEditor-drop-panel clearfix"></div>');
			var h = c('<div class="tip-triangle"></div>');
			g.css({
				width: k,
				height: i ? i : "auto"
			});
			g.append(h);
			g.append(f);
			j.$panel = g;
			j.$triangle = h
		};
		d.fn.initHideEvent = function() {
			var f = this;
			var g = f.$panel.get(0);
			e.$body.on("click", function(h) {
				if (!f.isShowing) {
					return
				}
				var k = h.target;
				var i = f.menu;
				var j;
				if (i.selected) {
					j = i.$domSelected.get(0)
				} else {
					j = i.$domNormal.get(0)
				}
				if (j === k || c.contains(j, k)) {
					return
				}
				if (g === k || c.contains(g, k)) {
					return
				}
				f.hide()
			});
			e.$window.scroll(function() {
				f.hide()
			});
			e.$window.on("resize", function() {
				f.hide()
			})
		}
	});
	b(function(e, c) {
		var d = e.DropPanel;
		d.fn._render = function() {
			var i = this;
			var h = i.onRender;
			var g = i.editor;
			var f = i.$panel;
			g.$editorContainer.append(f);
			h && h.call(i);
			i.rendered = true
		};
		d.fn._position = function() {
			var u = this;
			var h = u.$panel;
			var i = u.$triangle;
			var j = u.editor;
			var f = j.menuContainer.$menuContainer;
			var n = u.menu;
			var g = n.selected ? n.$domSelected : n.$domNormal;
			var q = g.offsetParent().position();
			var r = q.top;
			var p = q.left;
			var o = g.offsetParent().height();
			var s = g.offsetParent().width();
			var t = h.outerWidth();
			var w = j.txt.$txt.outerWidth();
			var v = r + o;
			var k = p + s / 2;
			var l = 0 - t / 2;
			var m = l;
			if ((0 - l) > (k - 10)) {
				l = 0 - (k - 10)
			}
			var x = (k + t + l) - w;
			if (x > -10) {
				l = l - x - 10
			}
			h.css({
				top: v,
				left: k,
				"margin-left": l
			});
			if (j._isMenufixed) {
				v = v + ((f.offset().top + f.outerHeight()) - h.offset().top);
				h.css({
					top: v
				})
			}
			i.css({
				"margin-left": m - l - 5
			})
		};
		d.fn.focusFirstInput = function() {
			var g = this;
			var f = g.$panel;
			f.find("input[type=text],textarea").each(function() {
				var h = c(this);
				if (h.attr("disabled") == null) {
					h.focus();
					return false
				}
			})
		};
		d.fn.show = function() {
			var h = this;
			var g = h.menu;
			if (!h.rendered) {
				h._render()
			}
			if (h.isShowing) {
				return
			}
			var f = h.$panel;
			f.show();
			h._position();
			h.isShowing = true;
			g.activeStyle(true);
			if (e.w3cRange) {
				h.focusFirstInput()
			} else {
				e.placeholderForIE8(f)
			}
		};
		d.fn.hide = function() {
			var h = this;
			var g = h.menu;
			if (!h.isShowing) {
				return
			}
			var f = h.$panel;
			f.hide();
			h.isShowing = false;
			g.activeStyle(false)
		}
	});
	b(function(d, c) {
		var e = function(f, g, h) {
				this.editor = f;
				this.menu = g;
				this.$content = h.$content;
				this.init()
			};
		e.fn = e.prototype;
		d.Modal = e
	});
	b(function(d, c) {
		var e = d.Modal;
		e.fn.init = function() {
			var f = this;
			f.initDom();
			f.initHideEvent()
		};
		e.fn.initDom = function() {
			var i = this;
			var g = i.$content;
			var h = c('<div class="wangEditor-modal"></div>');
			var f = c('<div class="wangEditor-modal-close"><i class="wangeditor-menu-img-cancel-circle"></i></div>');
			h.append(f);
			h.append(g);
			i.$modal = h;
			i.$close = f
		};
		e.fn.initHideEvent = function() {
			var h = this;
			var f = h.$close;
			var g = h.$modal.get(0);
			f.click(function() {
				h.hide()
			});
			d.$body.on("click", function(i) {
				if (!h.isShowing) {
					return
				}
				var l = i.target;
				var j = h.menu;
				var k;
				if (j) {
					if (j.selected) {
						k = j.$domSelected.get(0)
					} else {
						k = j.$domNormal.get(0)
					}
					if (k === l || c.contains(k, l)) {
						return
					}
				}
				if (g === l || c.contains(g, l)) {
					return
				}
				h.hide()
			})
		}
	});
	b(function(d, c) {
		var e = d.Modal;
		e.fn._render = function() {
			var h = this;
			var g = h.editor;
			var f = h.$modal;
			f.css("z-index", g.config.zindex + 10 + "");
			d.$body.append(f);
			h.rendered = true
		};
		e.fn._position = function() {
			var j = this;
			var f = j.$modal;
			var k = f.offset().top;
			var l = f.outerWidth();
			var g = f.outerHeight();
			var h = 0 - (l / 2);
			var i = 0 - (g / 2);
			if ((g / 2) > k) {
				i = 0 - k
			}
			f.css({
				"margin-left": h + "px",
				"margin-top": i + "px"
			})
		};
		e.fn.show = function() {
			var h = this;
			var g = h.menu;
			if (!h.rendered) {
				h._render()
			}
			if (h.isShowing) {
				return
			}
			h.isShowing = true;
			var f = h.$modal;
			f.show();
			h._position();
			g && g.activeStyle(true)
		};
		e.fn.hide = function() {
			var h = this;
			var g = h.menu;
			if (!h.isShowing) {
				return
			}
			h.isShowing = false;
			var f = h.$modal;
			f.hide();
			g && g.activeStyle(false)
		}
	});
	b(function(d, c) {
		var e = function(f) {
				this.editor = f;
				this.init()
			};
		e.fn = e.prototype;
		d.Txt = e
	});
	b(function(d, c) {
		var e = d.Txt;
		e.fn.init = function() {
			var j = this;
			var i = j.editor;
			var g = i.$valueContainer;
			var h = i.getInitValue();
			var f;
			if (g.get(0).nodeName === "DIV") {
				f = g;
				f.addClass("wangEditor-txt");
				f.attr("contentEditable", "true")
			} else {
				f = c('<div class="wangEditor-txt" contentEditable="true">' + h + "</div>")
			}
			i.ready(function() {
				j.insertEmptyP()
			});
			j.$txt = f;
			j.contentEmptyHandle();
			j.bindEnterForDiv();
			j.bindTabEvent();
			j.bindPasteFilter();
			j.bindFormatText();
			j.bindHtml()
		};
		e.fn.contentEmptyHandle = function() {
			var i = this;
			var h = i.editor;
			var g = i.$txt;
			var f;
			g.on("keyup", function(j) {
				if (j.keyCode !== 8) {
					return
				}
				var k = c.trim(g.html());
				if (!k || k === "<br>") {
					f = c("<p><br/></p>");
					g.html("");
					g.append(f);
					h.restoreSelectionByElem(f.get(0))
				}
			})
		};
		e.fn.bindEnterForDiv = function() {
			var k = d.config.legalTags;
			var j = this;
			var i = j.editor;
			var g = j.$txt;
			var f;

			function h() {
				if (!f) {
					return
				}
				var l = c("<p>" + f.html() + "</p>");
				f.after(l);
				f.remove()
			}
			g.on("keydown keyup", function(n) {
				if (n.keyCode !== 13) {
					return
				}
				var o = i.getRangeElem();
				var p = i.getLegalTags(o);
				var m;
				var l;
				if (!p) {
					p = i.getSelfOrParentByName(o, "div");
					if (!p) {
						return
					}
					m = c(p);
					if (n.type === "keydown") {
						f = m;
						setTimeout(h, 0)
					}
					if (n.type === "keyup") {
						l = c("<p>" + m.html() + "</p>");
						m.after(l);
						m.remove();
						i.restoreSelectionByElem(l.get(0), "start")
					}
				}
			})
		};
		e.fn.bindTabEvent = function() {
			var h = this;
			var g = h.editor;
			var f = h.$txt;
			f.on("keydown", function(i) {
				if (i.keyCode !== 9) {
					return
				}
				if (g.queryCommandSupported("insertHtml")) {
					g.command(i, "insertHtml", "&nbsp;&nbsp;&nbsp;&nbsp;")
				}
			})
		};
		e.fn.bindPasteFilter = function() {
			var n = this;
			var g = n.editor;
			var m = "";
			var f = n.$txt;
			var k = g.config.legalTags;
			var j = k.split(",");
			f.on("paste", function(q) {
				if (!g.config.pasteFilter) {
					return
				}
				m = "";
				var r, o;
				var p = q.clipboardData || q.originalEvent.clipboardData;
				if (p && p.getData) {
					r = p.getData("text/html");
					if (r) {
						o = c("<div>" + r + "</div>");
						i(o.get(0))
					} else {
						r = p.getData("text/plain");
						if (r) {
							r = r.replace(/[ ]/g, "&nbsp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/\n/g, "</p><p>");
							m = "<p>" + r + "</p>";
							m = m.replace(/<p>(https?:\/\/.*?)<\/p>/ig, function(t, s) {
								return '<p><a href="' + s + '" target="_blank">' + s + "</p>"
							})
						}
					}
				} else {
					if (window.clipboardData && window.clipboardData.getData) {
						m = window.clipboardData.getData("text");
						if (!m) {
							return
						}
						m = "<p>" + m + "</p>";
						m = m.replace((new RegExp("\n", "g"), "</p><p>"))
					} else {
						return
					}
				}
				if (m) {
					g.command(q, "insertHtml", m)
				}
			});

			function i(p) {
				if (!p || !p.nodeType || !p.nodeName) {
					return
				}
				var o;
				var q = p.nodeName.toLowerCase();
				var r = p.nodeType;
				if (r !== 3 && r !== 1) {
					return
				}
				if (q === "div") {
					o = c(p);
					o.children().each(function() {
						i(this)
					});
					return
				}
				if (j.indexOf(q) >= 0) {
					m += h(p)
				} else {
					if (r === 3) {
						m += "<p>" + p.textContent + "</p>"
					} else {
						if (["meta", "style", "script", "object", "form", "iframe"].indexOf(q) >= 0) {
							return
						}
						o = c(l(p));
						m += c("<div>").append(o).html()
					}
				}
			}
			function h(p) {
				var s = p.nodeName.toLowerCase();
				var o;
				var r = "";
				var q = "";
				if (["blockquote"].indexOf(s) >= 0) {
					o = c(p);
					return "<" + s + ">" + o.text() + "</" + s + ">"
				} else {
					if (["p", "h1", "h2", "h3", "h4", "h5"].indexOf(s) >= 0) {
						p = l(p);
						o = c(p);
						r = o.html();
						r = r.replace(/<.*?>/ig, function(t) {
							if (t === "</a>" || t.indexOf("<a ") === 0 || t.indexOf("<img ") === 0) {
								return t
							} else {
								return ""
							}
						});
						return "<" + s + ">" + r + "</" + s + ">"
					} else {
						if (["ul", "ol"].indexOf(s) >= 0) {
							o = c(p);
							o.children().each(function() {
								var t = c(l(this));
								var u = t.html();
								u = u.replace(/<.*?>/ig, function(v) {
									if (v === "</a>" || v.indexOf("<a ") === 0 || v.indexOf("<img ") === 0) {
										return v
									} else {
										return ""
									}
								});
								q += "<li>" + u + "</li>"
							});
							return "<" + s + ">" + q + "</" + s + ">"
						} else {
							o = c(l(p));
							return c("<div>").append(o).html()
						}
					}
				}
			}
			function l(r) {
				var p = r.attributes || [];
				var o = [];
				var s = ["href", "target", "src", "alt"];
				c.each(p, function(u, t) {
					if (t && t.nodeType === 2) {
						o.push(t.nodeName)
					}
				});
				c.each(o, function(u, t) {
					if (s.indexOf(t) < 0) {
						r.removeAttribute(t)
					}
				});
				var q = r.childNodes;
				if (q.length) {
					c.each(q, function(t, u) {
						l(u)
					})
				}
				return r
			}
		};
		e.fn.bindFormatText = function() {
			var l = this;
			var g = l.editor;
			var f = l.$txt;
			var i = d.config.legalTags;
			var h = i.split(",");
			var j = h.length;
			var k = [];
			c.each(h, function(m, o) {
				var n = ">\\s*<(" + o + ")>";
				k.push(new RegExp(n, "ig"))
			});
			k.push(new RegExp(">\\s*<(li)>", "ig"));
			k.push(new RegExp(">\\s*<(tr)>", "ig"));
			k.push(new RegExp(">\\s*<(code)>", "ig"));
			f.formatText = function() {
				var m = c("<div>");
				var n = f.html();
				n = n.replace(/\s*</ig, "<");
				c.each(k, function(o, p) {
					if (!p.test(n)) {
						return
					}
					n = n.replace(p, function(q, r) {
						return ">\n<" + r + ">"
					})
				});
				m.html(n);
				return m.text()
			}
		};
		e.fn.bindHtml = function() {
			var i = this;
			var h = i.editor;
			var f = i.$txt;
			var g = h.$valueContainer;
			var j = h.valueNodeName;
			f.html = function(k) {
				var l;
				if (j === "div") {
					l = c.fn.html.call(f, k)
				}
				if (k === undefined) {
					l = c.fn.html.call(f)
				} else {
					l = c.fn.html.call(f, k);
					g.val(k)
				}
				if (k === undefined) {
					return l
				}
			}
		}
	});
	b(function(d, c) {
		var e = d.Txt;
		var f = "propertychange change click keyup input paste";
		e.fn.render = function() {
			var h = this.$txt;
			var g = this.editor.$editorContainer;
			g.append(h)
		};
		e.fn.initHeight = function() {
			var h = this.editor;
			var g = this.$txt;
			var k = h.$valueContainer.height();
			var i = h.menuContainer.height();
			var j = k - i;
			j = j < 50 ? 50 : j;
			g.height(j);
			this.initMaxHeight(j, i)
		};
		e.fn.initMaxHeight = function(m, l) {
			var j = this.editor;
			var g = j.menuContainer.$menuContainer;
			var h = this.$txt;
			var i = c("<div>");
			if (window.getComputedStyle && "max-height" in window.getComputedStyle(h.get(0))) {
				var k = parseInt(j.$valueContainer.css("max-height"));
				if (isNaN(k)) {
					return
				}
				i.css({
					"max-height": (k - l) + "px",
					"overflow-y": "auto"
				});
				h.css({
					height: "auto",
					"overflow-y": "visible",
					"min-height": m + "px"
				});
				i.on("scroll", function() {
					if (h.parent().scrollTop() > 10) {
						g.addClass("wangEditor-menu-shadow")
					} else {
						g.removeClass("wangEditor-menu-shadow")
					}
				});
				h.wrap(i)
			}
		};
		e.fn.saveSelectionEvent = function() {
			var g = this.$txt;
			var h = this.editor;
			g.on(f + " focus blur", function(i) {
				h.saveSelection()
			});
			g.on("mousedown", function() {
				g.on("mouseleave.saveSelection", function(i) {
					h.saveSelection();
					h.updateMenuStyle()
				})
			}).on("mouseup", function() {
				g.off("mouseleave.saveSelection")
			})
		};
		e.fn.updateValueEvent = function() {
			var g = this.$txt;
			var i = this.editor;
			var k, j;

			function h() {
				var l = g.html();
				if (j === l) {
					return
				}
				if (i.onchange && typeof i.onchange === "function") {
					i.onchange.call(i)
				}
				i.updateValue();
				j = l
			}
			g.on(f, function(l) {
				if (j == null) {
					j = g.html()
				}
				if (k) {
					clearTimeout(k)
				}
				k = setTimeout(h, 100)
			})
		};
		e.fn.updateMenuStyleEvent = function() {
			var g = this.$txt;
			var h = this.editor;
			g.on(f, function(i) {
				h.updateMenuStyle()
			})
		};
		e.fn.insertEmptyP = function() {
			var h = this.$txt;
			var g = h.children();
			if (g.length === 0) {
				h.append(c("<p><br></p>"));
				return
			}
			if (g.last().html() !== "<br>") {
				h.append(c("<p><br></p>"))
			}
		};
		e.fn.showHeightOnHover = function() {
			var k = this.editor;
			var g = k.$editorContainer;
			var m = k.menuContainer;
			var i = this.$txt;
			var h = c('<i class="height-tip"><i>');
			var l = false;

			function j(o) {
				if (!l) {
					g.append(h);
					l = true
				}
				var y = i.position().top;
				var x = i.outerHeight();
				var p = o.height();
				var w = o.position().top;
				var r = parseInt(o.css("margin-top"), 10);
				var t = parseInt(o.css("padding-top"), 10);
				var q = parseInt(o.css("margin-bottom"), 10);
				var s = parseInt(o.css("padding-bottom"), 10);
				var u = p + t + r + s + q;
				var v = w + m.height();
				h.css({
					height: p + t + r + s + q,
					top: w + m.height()
				})
			}
			function n() {
				if (!l) {
					return
				}
				h.remove();
				l = false
			}
			i.on("mouseenter", "ul,ol,blockquote,p,h1,h2,h3,h4,h5,table,pre", function(o) {
				j(c(o.currentTarget))
			}).on("mouseleave", function() {
				n()
			})
		}
	});
	b(function(d, c) {
		d.langs = {};
		d.langs["zh-cn"] = {
			bold: "粗体/Ctrl+B",
			underline: "下划线/Ctrl+U",
			italic: "斜体/Ctrl+I",
			strikethrough: "删除线",
			eraser: "清除格式",
			undo: "Ctrl+Z",
		};
		d.langs.en = {
			bold: "Bold",
			underline: "Underline",
			italic: "Italic",
			strikethrough: "Strikethrough",
			eraser: "Eraser",
			undo: "Undo",
		}
	});
	b(function(d, c) {
		d.config = {};
		d.config.zindex = 10000;
		d.config.printLog = true;
		d.config.menuFixed = 0;
		d.config.jsFilter = true;
		d.config.legalTags = "p,h1,h2,h3,h4,h5,h6,blockquote,table,ul,ol,pre";
		d.config.lang = d.langs["zh-cn"];
		d.config.menus = ["bold", "underline", "italic", "strikethrough",  "undo", "eraser", ];
		d.config.pasteFilter = true
	});
	b(function(d, c) {
		d.UI = {};
		d.UI.menus = {
			"default": {
				normal: '<a href="#" tabindex="-1"><i class="wangeditor-menu-img-command"></i></a>',
				selected: ".selected"
			},
			bold: {
				normal: '<a href="#" tabindex="-1" style="font-weight:bold;font-size:15px">B</a>',
				selected: ".selected"
			},
			underline: {
				normal: '<a href="#" tabindex="-1" style="text-decoration:underline;font-size:15px">U</a>',
				selected: ".selected"
			},
			italic: {
				normal: '<a href="#" tabindex="-1" style="font-size:15px;font-style:italic">I</a>',
				selected: ".selected"
			},
			strikethrough: {
				normal: '<a href="#" tabindex="-1" style="font-size:15px;text-decoration:line-through">S</a>',
				selected: ".selected"
			},
			eraser: {
				normal: '<a href="#" tabindex="-1"  style="font-size:12px">清除</a>',
				selected: ".selected"
			},
			undo: {
				normal: '<a href="#" tabindex="-1" style="font-size:12px">撤销</a>',
				selected: ".selected"
			},
		}
	});
	b(function(d, c) {
		d.fn.initDefaultConfig = function() {
			var e = this;
			e.config = c.extend({}, d.config);
			e.UI = c.extend({}, d.UI)
		}
	});
	b(function(d, c) {
		d.fn.addEditorContainer = function() {
			this.$editorContainer = c('<div class="wangEditor-container"></div>')
		}
	});
	b(function(d, c) {
		d.fn.addTxt = function() {
			var e = this;
			var f = new d.Txt(e);
			e.txt = f
		}
	});
	b(function(d, c) {
		d.fn.addMenuContainer = function() {
			var e = this;
			e.menuContainer = new d.MenuContainer(e)
		}
	});
	b(function(d, c) {
		d.createMenuFns = [];
		d.createMenu = function(e) {
			d.createMenuFns.push(e)
		};
		d.fn.addMenus = function() {
			var f = this;
			var g = f.config.menus;

			function e(h) {
				if (g.indexOf(h) >= 0) {
					return true
				}
				return false
			}
			c.each(d.createMenuFns, function(i, h) {
				h.call(f, e)
			})
		}
	});
	b(function(d, c) {
		d.createMenu(function(e) {
			var i = "bold";
			if (!e(i)) {
				return
			}
			var f = this;
			var g = f.config.lang;
			var h = new d.Menu({
				editor: f,
				id: i,
				title: g.bold,
				commandName: "Bold"
			});
			h.clickEventSelected = function(j) {
				var k = f.isRangeEmpty();
				if (!k) {
					f.command(j, "Bold")
				} else {
					f.commandForElem("b,strong,h1,h2,h3,h4,h5", j, "Bold")
				}
			};
			f.menus[i] = h
		})
	});
	b(function(d, c) {
		d.createMenu(function(e) {
			var i = "underline";
			if (!e(i)) {
				return
			}
			var f = this;
			var g = f.config.lang;
			var h = new d.Menu({
				editor: f,
				id: i,
				title: g.underline,
				commandName: "Underline"
			});
			h.clickEventSelected = function(j) {
				var k = f.isRangeEmpty();
				if (!k) {
					f.command(j, "Underline")
				} else {
					f.commandForElem("u,a", j, "Underline")
				}
			};
			f.menus[i] = h
		})
	});
	b(function(d, c) {
		d.createMenu(function(e) {
			var i = "italic";
			if (!e(i)) {
				return
			}
			var f = this;
			var g = f.config.lang;
			var h = new d.Menu({
				editor: f,
				id: i,
				title: g.italic,
				commandName: "Italic"
			});
			h.clickEventSelected = function(j) {
				var k = f.isRangeEmpty();
				if (!k) {
					f.command(j, "Italic")
				} else {
					f.commandForElem("i", j, "Italic")
				}
			};
			f.menus[i] = h
		})
	});
	
	b(function(d, c) {
		d.createMenu(function(e) {
			var i = "strikethrough";
			if (!e(i)) {
				return
			}
			var f = this;
			var g = f.config.lang;
			var h = new d.Menu({
				editor: f,
				id: i,
				title: g.strikethrough,
				commandName: "StrikeThrough"
			});
			h.clickEventSelected = function(j) {
				var k = f.isRangeEmpty();
				if (!k) {
					f.command(j, "StrikeThrough")
				} else {
					f.commandForElem("strike", j, "StrikeThrough")
				}
			};
			f.menus[i] = h
		})
	});
	b(function(d, c) {
		d.createMenu(function(e) {
			var i = "eraser";
			if (!e(i)) {
				return
			}
			var f = this;
			var g = f.config.lang;
			var h = new d.Menu({
				editor: f,
				id: i,
				title: g.eraser,
				commandName: "RemoveFormat"
			});
			h.clickEvent = function(m) {
				var n = f.isRangeEmpty();
				if (!n) {
					f.command(m, "RemoveFormat");
					return
				}
				var j;

				function l() {
					var r = this;
					var v;
					var t, p;
					var u, q;
					var s, o;
					v = r.getRangeElem();
					u = r.getSelfOrParentByName(v, "blockquote");
					if (u) {
						q = c(u);
						j = c("<p>" + q.text() + "</p>");
						q.after(j).remove()
					}
					t = r.getSelfOrParentByName(v, "p,h1,h2,h3,h4,h5");
					if (t) {
						p = c(t);
						j = c("<p>" + p.text() + "</p>");
						p.after(j).remove()
					}
					s = r.getSelfOrParentByName(v, "ul,ol");
					if (s) {
						o = c(s);
						j = c("<p>" + o.text() + "</p>");
						o.after(j).remove()
					}
				}
				function k() {
					var o = this;
					if (j) {
						o.restoreSelectionByElem(j.get(0))
					}
				}
				f.customCommand(m, l, k)
			};
			f.menus[i] = h
		})
	});
	b(function(d, c) {
		d.createMenu(function(e) {
			var i = "undo";
			if (!e(i)) {
				return
			}
			var f = this;
			var g = f.config.lang;
			var h = new d.Menu({
				editor: f,
				id: i,
				title: g.undo
			});
			h.clickEvent = function(j) {
				f.undo()
			};
			f.menus[i] = h;
			f.ready(function() {
				var k = this;
				var j = k.txt.$txt;
				j.on("keydown", function(l) {
					if (l.keyCode !== 13) {
						return
					}
					k.undoRecord()
				});
				k.undoRecord()
			})
		})
	});
	b(function(d, c) {
		d.fn.renderMenus = function() {
			var e = this;
			var j = e.menus;
			var i = e.config.menus;
			var h = e.menuContainer;
			var g;
			var f = 0;
			c.each(i, function(l, m) {
				if (m === "|") {
					f++;
					return
				}
				g = j[m];
				if (g) {
					g.render(f)
				}
			})
		}
	});
	b(function(d, c) {
		d.fn.renderMenuContainer = function() {
			var f = this;
			var g = f.menuContainer;
			var e = f.$editorContainer;
			g.render()
		}
	});
	b(function(d, c) {
		d.fn.renderTxt = function() {
			var e = this;
			var f = e.txt;
			f.render();
			e.ready(function() {
				f.initHeight()
			})
		}
	});
	b(function(d, c) {
		d.fn.renderEditorContainer = function() {
			var j = this;
			var i = j.$valueContainer;
			var e = j.$editorContainer;
			var h = j.txt.$txt;
			var g, f;
			if (i === h) {
				g = j.$prev;
				f = j.$parent;
				if (g && g.length) {
					g.after(e)
				} else {
					f.prepend(e)
				}
			} else {
				i.after(e);
				i.hide()
			}
		}
	});
	b(function(d, c) {
		d.fn.eventMenus = function() {
			var e = this.menus;
			c.each(e, function(f, g) {
				g.bindEvent()
			})
		}
	});
	b(function(d, c) {
		d.fn.eventMenuContainer = function() {}
	});
	b(function(d, c) {
		d.fn.eventTxt = function() {
			var e = this.txt;
			e.saveSelectionEvent();
			e.updateValueEvent();
			e.updateMenuStyleEvent()
		}
	});
	b(function(d, c) {
		d.info("本页面富文本编辑器由 wangEditor 提供 http://wangeditor.github.io/ ")
	})
});