<?php
/*
 * page.php 分页类页面
 */
class page {
	public $total; //数据表中的总记录
	public $listRows; //每页显示的记录数
	public $limit; //每行显示的记录数
	public $uri;
	public $pageNum; //页数
	public $config; //分页数据显示配置参数
	public $listNum; //分页列表数目

	/***
	 * __construct 构造方法 参数初始化
	 * @$total 总记录数
	 * @$limit 每页显示记录数
	 */

	public function __construct($total, $listRows = 5) {
		$this->total = $total;
		$this->listRows = $listRows;
		$this->uri = $this->getUri(); //获取url
		$this->page = !empty ($_GET["page"]) ? $_GET["page"] : 1; //获取当前页面,若不存在则设为首页1
		$this->pageNum = ceil($this->total / $this->listRows); //总页数
		$this->limit = $this->setLimit(); //从第几条记录开始 显示到第几条记录
		$this->listNum = ceil($total / $listRows); //列表数
	}

	/**
	 *pagelist() 该方法返回分页列表
	 *@return linkPage
	 */

	public function pageList() {
		$linkPage = "";
		$inum = ceil($this->listNum / 2);

		for ($i = $inum-1; $i >= 1; $i--) {
			$page = $this->page - $i;
			if ($page < 1)
				continue;
			$linkPage .= "<a href='{$this->uri}&page={$page}'><span></span></a>";
		}
		$linkPage .= "<span class='current'></span>";
		for ($i = 1; $i < $this->listNum; $i++) {
			$page = $this->page + $i;
			if ($page <= $this->pageNum)
				$linkPage .= "<a href='{$this->uri}&page={$page}'><span></span></a>";
			else
				break;
		}
		return $linkPage;
	}

	/**
	 * getUri() 该方法返回去除了查询字符串page的url
	 * @return $url;
	 */
	public function getUri() {
		$url = $_SERVER["REQUEST_URI"].(strpos($_SERVER["REQUEST_URI"], '?')?"":"?"); //获取uri字符串 strpos函数检测$_server["request_uri"] 是否包含？ 存在则为空不存在则为？
		$parse = parse_url($url); //解析查询字符串
		$params = null;

		if (isset ($parse["query"])) {
			parse_str($parse['query'], $params); //parse_str()将uri中的查询字符串装入数组
			unset ($params['page']);
			$url = $parse['path'].'?'.http_build_query($params);
		}
		return $url; //从uri中去除page参数的url;
	}

	/**
	 *setLimti() 该方法返回当前页从第几条记录开始查询到第几条记录
	 */

	public function setLimit() {
		return 'Limit ' . ($this->page - 1) * $this->listRows . ",{$this->listRows}";
	}

	function fpage() {
		$html = $this->pageList();
		return $html;
	}
}
?>
