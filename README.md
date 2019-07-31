# Contao Google Charts Bundle

With this bundle you can visualize data with google charts api


### Description

This bundle uses the [cmen/google-charts-bundle](https://github.com/cmen/CMENGoogleChartsBundle) to display charts.
You can use this bundle to display a chart on its own or as a config element of the [heimrichhannot/contao-reader-bundle](https://github.com/heimrichhannot/contao-reader-bundle).



### Features
- display data using google charts api
- optional: adds a reader config element to [heimrichhannot/contao-reader-bundle](https://github.com/heimrichhannot/contao-reader-bundle)
- optional: adds a configuration for google maps reader config element to display a elevation chart


### Documentation

#### set up chart config

To display a chart at first you need to create a chart config.
Define here which type of chart you want to use and customize attributes of the chart.
You need to select a dataType as well. Currently there is `json` and `reference` to choose from. 
If you select `reference` as dataType you need to set the dataContainer and the dataField which holds the referenced data. 
You can also set a specific entity to get the data from. This is optional. If you do not set an entity it is set when you use the chart as a reader config element.
Otherwise you could set it by an event listener. If the entity is never set, you will get an error.

If you are done creating the chart config there are several ways to display the chart.

#### display chart by module

The simplest way to display the chart is to create a module that uses the chart configuration to show the chart in frontend.


#### display chart by reader config element

You can use the chart as reader config element in [heimrichhannot/contao-reader-bundle](https://github.com/heimrichhannot/contao-reader-bundle).
If you have set the dataType to `reference` in the chart configuration the entity will be set automatically by the current item id.

### DataTypes

When data is added to the chart it has to be of type array.

#### JSON

Enter valid json that contains pairs of x-/y-values.
Please do not enter the labels for the axis in this json but rather use the input fields labelX and labelY.

```
[
    ['value-x', 'value-y'],
    ['value-x', 'value-y'],
    ['value-x', 'value-y']
    ...
]
```

#### Reference

To use data that is provided by a certain entity you can use the reference dataType.
In the chart config set the dataContainer and dataField which holds the data.
Optional you can set the specific entity from which you want to retrieve the data. If you use the chart config for a reader config element the entity
will be set automatically when the config element of the item is generated.


#### how to modify the chart data

IMPORTANT: When you want to add data to the chart keep in mind that this data HAS TO BE AN ARRAY. You can modify the data in two different ways. 

##### DataType

You can add a custom dataType which will be selectable in chart config.
Here data is configured and added to the dataType by the `setData` method.
For example for dataType `reference` the data is pulled here from the referenced entity
which is selected by the values (dataContainer, dataField, dataEntity) you've set in the chart configuration.

DataTypes are added as services. Add the '_instanceof' part to your service.yml and add your dataType class like in this example.

```
services:
  _instanceof:
      HeimrichHannot\GoogleChartsBundle\DataType\DataTypeInterface:
        tags: ['huh.google_charts.data_type']

# DataTypes
  
  HeimrichHannot\GoogleChartsBundle\DataType\Concrete\DataTypeJson: ~
  HeimrichHannot\GoogleChartsBundle\DataType\Concrete\DataTypeReference: ~

```


##### GoogleChartsModifyChartDataEvent
 
Independant from the dataType you've chosen you can modify the chart data by this event.
The event holds the chart config and the data that was set by the dataType as parameters.
To modify the data you need to set the data in the event using the `setData` method
 
