<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Ciconia\Ciconia;
use Ciconia\Extension\Gfm;

class MarkdownServiceProvider extends ServiceProvider {

	
	protected $markdown;
	
	//protected $defer = true;
	
	
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->markdown = new Ciconia();
		$this->markdown->addExtension(new Gfm\FencedCodeBlockExtension());
        $this->markdown->addExtension(new Gfm\TaskListExtension());
        $this->markdown->addExtension(new Gfm\InlineStyleExtension());
        $this->markdown->addExtension(new Gfm\WhiteSpaceExtension());
        $this->markdown->addExtension(new Gfm\TableExtension());
        $this->markdown->addExtension(new Gfm\UrlAutoLinkExtension());
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('Markdown', function () {
            return $this->markdown;
        });
	}

}
