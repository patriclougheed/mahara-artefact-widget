The widget artefact allows you to publish portfolio's blocks to an Open Social container - i.e.portal, iGoogle, etc.
### Printscreen ###
![http://mahara-artefact-widget.googlecode.com/hg/theme/raw/static/images/printscreen/printscreen1.png](http://mahara-artefact-widget.googlecode.com/hg/theme/raw/static/images/printscreen/printscreen1.png)
![http://mahara-artefact-widget.googlecode.com/hg/theme/raw/static/images/printscreen/printscreen2.png](http://mahara-artefact-widget.googlecode.com/hg/theme/raw/static/images/printscreen/printscreen2.png)

### How it works ###
Add the "Publish Widget" block to your porfolio.

If you want to add the portfolio to iGoogle click on the "add to iGoogle" button.

If you want to add the portfolio to another Open Social container click on the module icon. Copy the url that points to the xml module description. Paste the module url to your Open Social container.

To select a block in the portfolio. Go to your container - portal, iGoogle - select the block's options, choose the block you want to display.

Once you have added your portfolio to a container you can remove the "Publish Widget" block.

The list of blocks displayed in parameters is refreshed every x minutes. If you have added a new block on your porfolio and it is not listed in the list you can either wait enough time for the cache to refresh or republish the portfolio by clicking on the button.

### Get the code ###
To get the latest code you need to clone the repository using a mercurial client. Windows users can use TortoiseHG http://tortoisehg.bitbucket.org/ for that. See the Source tab for more details.

Or you can download a release from the Downloads tab.

### Install ###
Copy the code in Mahara to

> mahara/artefact/widget

Install you artefact as usual

  1. Go to Mahara->administration->Extentions
  1. Install the artefact
  1. Install the corresponding block