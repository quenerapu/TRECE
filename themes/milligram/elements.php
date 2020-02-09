<div class="container" style="margin-top:4em;">

  <hr>

  <div class="row">

    <div class="column">

      <h1>😍 TRECE was successfuly installed.</h1>

      <p>The following is just a sample of the html/css elements in action using the <strong><?=$conf["trece"]["theme-name"];?> Theme</strong>. You can remove this part of the page simply by <mark>renaming or removing</mark> the file <code><?=$conf["dir"]["themes"].$conf["trece"]["theme"]."/".$conf["file"]["elements"].".php";?></code> or <mark>commenting or removing</mark> the following lines at the <code>index.php</code> file:</p>
      <pre><code>
        if(file_exists($conf["dir"]["themes"].$conf["trece"]["theme"]."/".$conf["file"]["elements"].".php")):
          require_once($conf["dir"]["themes"].$conf["trece"]["theme"]."/".$conf["file"]["elements"].".php");
        endif;
      </code></pre>

    </div>

  </div>

  <hr>

  <div class="row">

    <div class="column">

      <h1>Heading 1</h1>
      <h2>Heading 2</h2>
      <h3>Heading 3</h3>
      <h4>Heading 4</h4>
      <h5>Heading 5</h5>
      <h6>Heading 6</h6>

    </div>

  </div>

  <hr>

  <div class="row">

    <div class="column">

      <h3>Paragraph</h3>
      <p>A paragraph (from the Greek paragraphos, “to write beside” or “written beside”) is a self-contained unit of a discourse in writing dealing with a particular point or idea. A paragraph consists of one or more sentences. Though not required by the syntax of any language, paragraphs are usually an expected part of formal writing, used to organize longer prose.</p>

    </div>

    <div class="column">

    <h3>Blockquote</h3>
    <blockquote>
      <p>A block quotation (also known as a long quotation or extract) is a quotation in a written document, that is set off from the main text as a paragraph, or block of text.</p>
      <p>It is typically distinguished visually using indentation and a different typeface or smaller size quotation. It may or may not include a citation, usually placed at the bottom.</p>
      <cite><a href="#!">Said no one, ever.</a></cite>
    </blockquote>

    </div>

  </div>

  <hr>

  <div class="row">

    <div class="column">

      <h3>Definition list</h3>
      <dl>
        <dt>Definition List Title</dt>
        <dd>This is a definition list division.</dd>
      </dl>

    </div>

    <div class="column">

      <h3>Ordered List</h3>
      <ol>
        <li>List Item 1</li>
        <li>List Item 2</li>
        <li>List Item 3</li>
      </ol>

    </div>

    <div class="column">

      <h3>Unordered List</h3>
      <ul>
        <li>List Item 1</li>
        <li>List Item 2</li>
        <li>List Item 3</li>
      </ul>

    </div>

  </div>

  <hr>

  <div class="row">

    <div class="column">

      <h3>Table</h3>
      <table>
        <caption>Table Caption</caption>
        <thead>
          <tr>
            <th>Table Heading 1</th>
            <th>Table Heading 2</th>
            <th>Table Heading 3</th>
            <th>Table Heading 4</th>
            <th>Table Heading 5</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Table Footer 1</th>
            <th>Table Footer 2</th>
            <th>Table Footer 3</th>
            <th>Table Footer 4</th>
            <th>Table Footer 5</th>
          </tr>
        </tfoot>
        <tbody>
          <tr>
            <td>Table Cell 1</td>
            <td>Table Cell 2</td>
            <td>Table Cell 3</td>
            <td>Table Cell 4</td>
            <td>Table Cell 5</td>
          </tr>
          <tr>
            <td>Table Cell 1</td>
            <td>Table Cell 2</td>
            <td>Table Cell 3</td>
            <td>Table Cell 4</td>
            <td>Table Cell 5</td>
          </tr>
          <tr>
            <td>Table Cell 1</td>
            <td>Table Cell 2</td>
            <td>Table Cell 3</td>
            <td>Table Cell 4</td>
            <td>Table Cell 5</td>
          </tr>
          <tr>
            <td>Table Cell 1</td>
            <td>Table Cell 2</td>
            <td>Table Cell 3</td>
            <td>Table Cell 4</td>
            <td>Table Cell 5</td>
          </tr>
        </tbody>
      </table>

    </div>

  </div>

  <hr>

  <div class="row">

    <div class="column">

      <h3>Code</h3>
      <p>
        <strong>Keyboard input:</strong> <kbd>Cmd</kbd><br>
        <strong>Inline code:</strong> <code>&lt;div&gt;code&lt;/div&gt;</code><br>
        <strong>Sample output:</strong> <samp>This is sample output from a computer program.</samp>
      </p>

    </div>

    <div class="column">

      <h3>Preformatted text</h3>
      <pre>P R E F O R M A T T E D T E X T
! " # $ % &amp; ' ( ) * + , - . /
0 1 2 3 4 5 6 7 8 9 : ; &lt; = &gt; ?
@ A B C D E F G H I J K L M N O
P Q R S T U V W X Y Z [ \ ] ^ _
` a b c d e f g h i j k l m n o
p q r s t u v w x y z { | } ~ </pre>

    </div>

  </div>

  <hr>

  <div class="row">

    <div class="column">

      <h3>Inline elements</h3>
      <div class="float-left">
        <figure>
          <img src="https://placekitten.com/666/666" class="float-image float-image-left" alt="Image alt text">
          <figcaption>Here is a caption for this image.</figcaption>
        </figure>
      </div>
      <p>
        <a href="#!">This is a text link</a>. <strong>Strong is used to indicate strong importance</strong>. <em>This text has added emphasis</em>. The <b>b element</b> is stylistically different text from normal text, without any special importance. The <i>i element</i> is text that is offset from the normal text. The <u>u element</u> is text with an unarticulated, though explicitly rendered, non-textual annotation. This line contains <code>$var= "a bit of code";</code>. <del>This text is deleted</del> and <ins>This text is inserted</ins>. <s>This text has a strikethrough</s>. Superscript<sup>®</sup>. Subscript for things like H<sub>2</sub>O. <small>This small text is small for for fine print, etc.</small> Abbreviation: <abbr title="HyperText Markup Language">HTML</abbr> <q cite="https://developer.mozilla.org/en-US/docs/HTML/Element/q">This text is a short inline quotation.</q> <cite>This is a citation.</cite> The <dfn>dfn element</dfn> indicates a definition. The <mark>mark element</mark> indicates a highlight. The <var>variable element</var>, such as <var>x</var> = <var>y</var>. The time element: <time datetime="2013-04-06T12:32+00:00">2 weeks ago</time>
      </p>

    </div>

  </div>

  <hr>

  <div class="row">

    <div class="column">

      <h3>No <code>&lt;figure&gt;</code> element</h3>
      <p>
        <img src="https://placekitten.com/666/666" alt="Image alt text">
      </p>

    </div>

    <div class="column">

      <h3><code>&lt;figure&gt;</code> with <code>&lt;figcaption&gt;</code></h3>
      <figure>
        <img src="https://placekitten.com/666/666" alt="Image alt text">
        <figcaption>Here is a caption for this image.</figcaption>
      </figure>

    </div>

  </div>

  <hr>

  <div class="row">

    <div class="column">

      <h3>Audio</h3>
      <div>
        <audio controls="">audio</audio>
      </div>

    </div>

    <div class="column">

      <h3>Video</h3>
      <div>
        <video controls="">video</video>
      </div>

    </div>

    <div class="column">

      <h3>Canvas</h3>
      <div>
        <canvas>canvas</canvas>
      </div>

    </div>

  </div>

  <hr>

  <div class="row">

    <div class="column">

      <h3>Meter</h3>
      <div>
        <meter value="3" min="0" max="10">3 out of 10</meter>
      </div>

    </div>

    <div class="column">

      <h3>Progress</h3>
      <div>
        <progress>progress</progress>
      </div>

    </div>

    <div class="column">

      <h3>Inline SVG</h3>
      <div>
        <svg width="200px" height="100px"><circle cx="100" cy="100" r="100" fill="#1fa3ec"></circle></svg>
      </div>

    </div>

  </div>

  <hr>

  <div class="row">

    <div class="column">

      <h3>Form</h3>
      <form>

        <fieldset>

          <legend>Input fields</legend>

          <div class="row">

            <div class="column">

              <p>
                <label for="input__text">Text Input</label>
                <input id="input__text" type="text" placeholder="Text Input">
              </p>

            </div>

            <div class="column">

              <p>
                <label for="input__password">Password</label>
                <input id="input__password" type="password" placeholder="Type your Password">
              </p>

            </div>

          </div>

          <div class="row">

            <div class="column">

              <p>
                <label for="textarea">Textarea</label>
                <textarea id="textarea" rows="8" cols="48" placeholder="Enter your message here"></textarea>
              </p>

            </div>

          </div>

          <div class="row">

            <div class="column">

              <p>
                <label for="input__webaddress">Web Address</label>
                <input id="input__webaddress" type="url" placeholder="https://yoursite.com">
              </p>

            </div>

            <div class="column">

              <p>
                <label for="input__emailaddress">Email Address</label>
                <input id="input__emailaddress" type="email" placeholder="name@email.com">
              </p>

            </div>

          </div>

          <div class="row">

            <div class="column">

              <p>
                <label for="input__phone">Phone Number</label>
                <input id="input__phone" type="tel" placeholder="(999) 999-9999">
              </p>

            </div>

            <div class="column">

              <p>
                <label for="input__search">Search</label>
                <input id="input__search" type="search" placeholder="Enter Search Term">
              </p>

            </div>

          </div>

          <div class="row">

            <div class="column">

              <p>
                <label for="input__number">Number</label>
                <input id="input__number" type="number" placeholder="Enter a Number">
              </p>

            </div>

            <div class="column">

              <p>
                <label for="input__date">Date</label>
                <input type="date" id="input__date" placeholder="">
              </p>

            </div>

          </div>

          <div class="row">

            <div class="column">

              <p>
                <label for="input__color">Color</label>
                <input type="color" id="input__color" value="#000000">
              </p>

            </div>

            <div class="column">

              <p>
                <label for="input__valid" class="valid">Valid</label>
                <input id="input__valid" class="valid" type="text" placeholder="Valid">
              </p>

            </div>

            <div class="column">

              <p>
                <label for="input__error" class="error">Error</label>
                <input id="input__error" class="error" type="text" placeholder="Error">
              </p>

            </div>

          </div>

          <div class="row">

            <div class="column">

              <p>
                <label for="select">Select</label>
                <select id="select">
                  <optgroup label="Option Group">
                    <option>Option One</option>
                    <option>Option Two</option>
                    <option>Option Three</option>
                  </optgroup>
                </select>
              </p>

            </div>

          </div>

          <div class="row">

            <div class="column">

              <legend>Checkboxes</legend>
              <p>
                <ul class="list list-clean">
                  <li><label for="checkbox1"><input id="checkbox1" name="checkbox" type="checkbox" checked="checked"> Choice A</label></li>
                  <li><label for="checkbox2"><input id="checkbox2" name="checkbox" type="checkbox"> Choice B</label></li>
                  <li><label for="checkbox3"><input id="checkbox3" name="checkbox" type="checkbox"> Choice C</label></li>
                </ul>
              </p>

            </div>

            <div class="column">

              <legend>Radio buttons</legend>
              <p>
                <ul class="list list-clean">
                  <li><label for="radio1"><input id="radio1" name="radio" type="radio" class="radio" checked="checked"> Option 1</label></li>
                  <li><label for="radio2"><input id="radio2" name="radio" type="radio" class="radio"> Option 2</label></li>
                  <li><label for="radio3"><input id="radio3" name="radio" type="radio" class="radio"> Option 3</label></li>
                </ul>
              </p>

            </div>

          </div>

          <div class="row">

            <div class="column">

              <legend>Buttons</legend>

              <div class="row">

                <div class="column">

                  <p>
                    <input type="submit" value="<input type=submit>"><br>
                    <input type="button" value="<input type=button>"><br>
                    <input type="reset" value="<input type=reset>"><br>
                    <input type="submit" value="<input disabled>" disabled>
                  </p>

                </div>

                <div class="column">

                  <p>
                    <button type="submit">&lt;button type=submit&gt;</button><br>
                    <button type="button">&lt;button type=button&gt;</button><br>
                    <button type="reset">&lt;button type=reset&gt;</button><br>
                    <button type="button" disabled>&lt;button disabled&gt;</button>
                  </p>

                </div>

              </div>

            </div>

          </div>

        </fieldset>

      </form>

    </div>

  </div>

</div>
